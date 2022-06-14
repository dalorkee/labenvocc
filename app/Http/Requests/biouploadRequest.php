<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class biouploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'uploadbio' => 'required|mimes:xlsx,xls',
            'type_of_work' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'uploadbio.required' => 'โปรดเลือกไฟล์ Excel',
            'type_of_work.required' => 'ประเภทงานห้ามมีค่าว่าง'
        ];
    }

}
