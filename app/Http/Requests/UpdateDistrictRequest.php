<?php

namespace App\Http\Requests;

use App\Models\District;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDistrictRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('district_edit');
    }

    public function rules()
    {
        return [
            'id_regency' => [
                'string',
                'nullable',
            ],
            'id_district' => [
                'string',
                'nullable',
            ],
            'district_name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
