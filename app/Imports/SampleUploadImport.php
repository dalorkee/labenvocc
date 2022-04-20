<?php

namespace App\Imports;

use App\Models\SampleUpload;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SampleUploadImport implements ToModel, WithHeadingRow
{
    /**

    * @param array $row

    *

    * @return \Illuminate\Database\Eloquent\Model|null

    */

    public function model(array $row)
    {
        return new SampleUpload([
            'title_name' => $row['title_name'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'age_year' => $row['age_year'],
            'division' => $row['division'],
            'work_life_year' => $row['work_life_year'],
            'note' => $row['note'],
            'sample_sender_name' => $row['sample_sender_name'],
            'phone_sample_sender' => $row['phone_sample_sender'],
            'email_sample_sender' => $row['email_sample_sender'],
            'user_entry' => auth()->user()->id
        ]);
    }
}
