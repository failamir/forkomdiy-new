<?php

namespace App\Http\Requests;

use App\Models\Instansi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreInstansiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('instansi_create');
    }

    public function rules()
    {
        return [
            'company_name' => [
                'string',
                'nullable',
            ],
            'company_address' => [
                'string',
                'nullable',
            ],
            'company_website' => [
                'string',
                'nullable',
            ],
            'company_email' => [
                'string',
                'nullable',
            ],
            'level_id' => [
                'integer',
                'nullable',
            ],
            'prov' => [
                'string',
                'nullable',
            ],
            'regency_id' => [
                'integer',
                'nullable',
            ],
            'district_id' => [
                'integer',
                'nullable',
            ],
            'village_id' => [
                'integer',
                'nullable',
            ],
            'user_id' => [
                'integer',
                'nullable',
            ],
        ];
    }
}
