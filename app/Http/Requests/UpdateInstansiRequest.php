<?php

namespace App\Http\Requests;

use App\Models\Instansi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateInstansiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('instansi_edit');
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
        ];
    }
}
