<?php

namespace App\Http\Requests;

use App\Models\Village;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVillageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('village_create');
    }

    public function rules()
    {
        return [
            'id_district' => [
                'string',
                'nullable',
            ],
            'id_village' => [
                'string',
                'nullable',
            ],
            'village_name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
