<?php

namespace Dipantry\CekOngkir\Service\App;

use Dipantry\CekOngkir\Dto\LogisticDto;
use Dipantry\CekOngkir\Dto\RateDto;
use Dipantry\CekOngkir\Models\CKCourier;
use Dipantry\CekOngkir\Models\CKRate;

class DatabaseService
{
    public function saveLogistics(LogisticDto $dto): void
    {
        $courier = CKCourier::find($dto->id);

        if (!$courier) {
            $courier = new CKCourier();
            $courier->id = $dto->id;
            $courier->name = $dto->name;
            $courier->code = $dto->code;
            $courier->image_url = $dto->logoUrl;
            $courier->company_name = $dto->companyName;
            $courier->is_active = $dto->status;

            $courier->save();
        }
    }

    public function saveRates(RateDto $dto): void
    {
        $rate = CKRate::find($dto->id);

        if (!$rate) {
            $rate = new CKRate();

            $rate->id = $dto->id;
            $rate->name = $dto->name;
            $rate->type = $dto->type;
            $rate->courier_id = $dto->courier_id;

            $rate->save();
        }
    }
}