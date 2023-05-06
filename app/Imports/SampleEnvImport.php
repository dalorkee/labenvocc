<?php

namespace App\Imports;

use App\Models\OrderSample;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SampleEnvImport implements ToModel, WithHeadingRow
{
    /**

    * @param array $row

    *

    * @return \Illuminate\Database\Eloquent\Model|null

    */
    protected $orderId;
    protected $sampleDate;
    public function __construct($orderId, $sampleDate)
    {
        $this->orderId = $orderId;
        $this->sampleDate = $sampleDate;
    }

    public function model(array $row)
    {
        return new OrderSample([
            'order_id' => $this->orderId,
            'sample_collection_method' => $row['sample_collection_method'],
            'kind_of_sample' => $row['kind_of_sample'],
            'collection_point' => $row['collection_point'],
            'weight_sample' => $row['weight_sample'],
            'air_volume' => $row['air_volume'],
            'sample_date' => $this->sampleDate,
            'note' => $row['note']
        ]);
    }
}
