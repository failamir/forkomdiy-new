<?php

namespace App\Http\Requests;

use App\Models\Kontak;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreKontakRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kontak_create');
    }

    public function rules()
    {
        return [
            'contact_first_name' => [
                'string',
                'nullable',
            ],
            'contact_last_name' => [
                'string',
                'nullable',
            ],
            'contact_phone_1' => [
                'string',
                'nullable',
            ],
            'contact_phone_2' => [
                'string',
                'nullable',
            ],
            'contact_email' => [
                'string',
                'nullable',
            ],
            'contact_skype' => [
                'string',
                'nullable',
            ],
            'contact_address' => [
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
