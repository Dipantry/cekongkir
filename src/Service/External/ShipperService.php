<?php

namespace Dipantry\CekOngkir\Service\External;

use Dipantry\CekOngkir\Constants\Operations;
use Dipantry\CekOngkir\Constants\Queries;
use Dipantry\CekOngkir\Constants\URLs;
use Dipantry\CekOngkir\Dto\DomesticOngkirRequest;
use Dipantry\CekOngkir\Dto\LogisticDto;
use Dipantry\CekOngkir\Dto\PersonDto;
use Dipantry\CekOngkir\Dto\PricingDto;
use Dipantry\CekOngkir\Dto\RateDto;
use Dipantry\CekOngkir\Dto\TrackingDetailDto;
use Dipantry\CekOngkir\Dto\TrackingDto;
use Dipantry\CekOngkir\Exception\ApiResponseException;
use Dipantry\CekOngkir\Models\CKCourier;
use Dipantry\CekOngkir\Service\App\DatabaseService;
use Dipantry\CekOngkir\Service\Service;

class ShipperService extends Service
{
    private DatabaseService $databaseService;

    public function __construct(int $timeout = 30)
    {
        parent::__construct($timeout);

        $this->databaseService = new DatabaseService();
    }

    /**
     * @throws ApiResponseException
     */
    public function getLogistics(): array
    {
        $data = $this->postHttp(
            URLs::$query,
            operationName: Operations::$logistics,
            query: Queries::$logistics,
        );

        $jsonData = json_decode($data, true);
        $logistics = $jsonData['logistics']['edges'];

        $result = [];

        foreach ($logistics as $logistic) {
            $node = $logistic['node'];

            $dto = new LogisticDto(
                id: $node['id'],
                name: $node['name'],
                code: $node['code'],
                logoUrl: $node['logoURL'],
                companyName: $node['companyName'],
                status: $node['status']
            );

            if (config('cekongkir.save_new_data')) {
                $this->databaseService->saveLogistics($dto);
            }

            $result[] = $dto;
        }

        return $result;
    }

    /**
     * @throws ApiResponseException
     */
    public function getLogisticsSuggestions(string $trackingNumber): array
    {
        $data = $this->postHttp(
            URLs::$query,
            operationName: Operations::$logisticsSuggestion,
            variables: [
                'payload' => [
                    'referenceNo' => $trackingNumber,
                ]
            ],
            query: Queries::$logisticsSuggestion
        );

        $jsonData = json_decode($data, true);
        $logisticIds = $jsonData['logisticRefSuggestion'];

        $result = [];
        foreach ($logisticIds as $logisticId) {
            $result[] = CKCourier::find($logisticId);
        }

        return $result;
    }

    /**
     * @throws ApiResponseException
     */
    public function getDomesticOngkir(DomesticOngkirRequest $request, string $token = null): array
    {
        if ($token == null || $token == '') {
            throw new ApiResponseException("Token is null");
        }

        $data = $this->postHttp(
            URLs::$query,
            operationName: Operations::$ongkir,
            variables: [
                'payload' => [
                    'originAreaId' => $request->originId,
                    'destinationAreaId' => $request->destinationId,
                    'weight' => $request->weight,
                    'width' => $request->width,
                    'length' => $request->length,
                    'height' => $request->height,
                    'itemValue' => $request->quantity,
                    'validToOrder' => true
                ]
            ],
            query: Queries::$ongkir
        );

        $jsonData = json_decode($data, true);
        $pricing = $jsonData['pricingDomestic']['edges'];

        $result = [];

        foreach ($pricing as $item) {
            $node = $item['node'];

            if (config('cekongkir.save_new_data')) {
                $logistic = $node['logistic'];
                $logisticDto = new LogisticDto(
                    id: $logistic['id'],
                    name: $logistic['name'],
                    code: $logistic['code'],
                    logoUrl: $logistic['logoURL'],
                    companyName: $logistic['companyName'],
                    status: $logistic['status']
                );
                $this->databaseService->saveLogistics($logisticDto);

                $rate = $node['rate'];
                $rateDto = new RateDto(
                    id: $rate['id'],
                    name: $rate['name'],
                    type: $rate['type'],
                    courier_id: $logistic['id']
                );
                $this->databaseService->saveRates($rateDto);
            }

            $dto = new PricingDto(
                courierId: $node['logistic']['id'],
                rateId: $node['rate']['id'],
                totalPrice: $node['totalPrice'],
                minDay: $node['minDay'],
                maxDay: $node['maxDay'],
                finalPrice: $node['finalPrice'],
                discountedPrice: $node['discountedPrice'],
                insurancePrice: $node['insuranceFee'],
                surchargePrice: $node['surchargeFee'],
                discountValue: $node['discountedValue']
            );

            $result[] = $dto;
        }

        return $result;
    }

    /**
     * @throws ApiResponseException
     */
    public function getTracking(string $courierId, string $trackingNumber, string $token = null): TrackingDto|array
    {
        if ($token == null || $token == '') {
            throw new ApiResponseException("Token is null");
        }

        $data = $this->postHttp(
            URLs::$query,
            operationName: Operations::$tracking,
            variables: [
                'input' => [
                    'logisticId' => $courierId,
                    'referenceNo' => $trackingNumber,
                ]
            ],
            query: Queries::$tracking
        );

        $jsonData = json_decode($data, true);
        $tracking = $jsonData['trackingDirect'][0];

        $details = [];

        foreach ($tracking['details'] as $trackingDetail) {
            $detailDto = new TrackingDetailDto(
                dateTime: $trackingDetail['datetime'],
                name: $trackingDetail['logistic']['name'],
                description: $trackingDetail['logistic']['description']
            );

            $details[] = $detailDto;
        }

        $senderDto = new PersonDto(
            name: $tracking['consigner']['name'],
            address: $tracking['consigner']['address']
        );

        $recipientDto = new PersonDto(
            name: $tracking['consignee']['name'],
            address: $tracking['consignee']['address']
        );

        return new TrackingDto(
            trackingNumber: $trackingNumber,
            courierId: $courierId,
            shipmentDate: $tracking['shipmentDate'],
            details: $details,
            sender: $senderDto,
            recipient: $recipientDto,
        );
    }
}