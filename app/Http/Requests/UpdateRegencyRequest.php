<?php

namespace App\Http\Requests;

use App\Models\Regency;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRegencyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('regency_edit');
    }

    public function rules()
    {
        return [
            'id_province' => [
                'string',
                'nullable',
            ],
            'id_regency' => [
                'string',
                'nullable',
            ],
            'regency_name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
