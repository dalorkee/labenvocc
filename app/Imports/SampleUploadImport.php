<?php

namespace App\Imports;

use App\Models\OrderSample;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SampleUploadImport implements ToModel, WithHeadingRow
{
    /**

    * @param array $row

    *

    * @return \Illuminate\Database\Eloquent\Model|null

    */
    protected $orderId;
    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    public function model(array $row)
    {
        return new OrderSample([
            'order_id' => $this->orderId,
            'title_name' => $row['title_name'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'age_year' => $row['age_year'],
            'division' => $row['division'],
            'work_life_year' => $row['work_life_year'],
            'note' => $row['note']
        ]);
    }
}
