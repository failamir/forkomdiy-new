<?php

namespace App\Http\Requests;

use App\Models\Kontak;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateKontakRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kontak_edit');
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
        ];
    }
}
