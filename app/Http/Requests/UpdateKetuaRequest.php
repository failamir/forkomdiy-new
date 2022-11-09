<?php

namespace App\Http\Requests;

use App\Models\Ketua;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateKetuaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ketua_edit');
    }

    public function rules()
    {
        return [
            'periode' => [
                'string',
                'nullable',
            ],
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
