<?php

namespace Dipantry\CekOngkir\Service\external;

use Dipantry\CekOngkir\Constants\Operations;
use Dipantry\CekOngkir\Constants\Queries;
use Dipantry\CekOngkir\Constants\URLs;
use Dipantry\CekOngkir\Dto\DomesticOngkirRequest;
use Dipantry\CekOngkir\Dto\LogisticDto;
use Dipantry\CekOngkir\Dto\PricingDto;
use Dipantry\CekOngkir\Exception\ApiResponseException;
use Dipantry\CekOngkir\Models\CKCourier;
use Dipantry\CekOngkir\Service\Service;

class ShipperService extends Service
{
    public function __construct(int $timeout = 30)
    {
        parent::__construct($timeout);
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
                $node['id'], $node['name'], $node['code'],
                $node['logoURL'], $node['companyName'], $node['status']
            );

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
    public function getDomesticOngkir(DomesticOngkirRequest $request): array
    {
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

            $dto = new PricingDto(
                $node['logistic']['id'],
                $node['rate']['id'],
                $node['totalPrice'],
                $node['minDay'],
                $node['maxDay'],
                $node['finalPrice'],
                $node['discountedPrice'],
                $node['insuranceFee'],
                $node['surchargeFee'],
                $node['discountedValue']
            );

            $result[] = $dto;
        }

        return $result;
    }

    /**
     * @throws ApiResponseException
     */
    public function getTracking(string $courierId, string $trackingNumber): array
    {
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
        $tracking = $jsonData['trackingDirect'];

        $details = [];

        foreach ($tracking['details'] as $trackingDetail) {
            $detail['datetime'] = $trackingDetail['datetime'];
            $detail['shipper']['name'] = $trackingDetail['shipper']['name'];
            $detail['shipper']['description'] = $trackingDetail['shipper']['description'];
            $detail['logistic']['name'] = $trackingDetail['logistic']['name'];
            $detail['logistic']['description'] = $trackingDetail['logistic']['description'];

            $details[] = $detail;
        }

        return [
            'trackingNumber' => $trackingNumber,
            'courier' => CKCourier::find($courierId),
            'shipmentDate' => $tracking['shipmentDate'],
            'details' => $details,
            'sender' => [
                'name' => $tracking['consigner']['name'],
                'address' => $tracking['consigner']['address'],
            ],
            'receiver' => [
                'name' => $tracking['consignee']['name'],
                'address' => $tracking['consignee']['address'],
            ]
        ];
    }
}