<?php

namespace App\Imports;

use App\Models\CouponVarations;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
class CouponsVarationsImport implements ToModel, WithBatchInserts, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable;
    public function model(array $row)
    {
        return new CouponVarations([
            'coupon_id'=>$row[0],
            'parent_sku'=>$row[1],
            'coupon_code'=>$row[2],
            'varation_sku'=>$row[3],
        ]);

    }
    public function batchSize(): int
    {
        return 100;
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
