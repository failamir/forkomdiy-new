<?php

namespace App\Http\Requests;

use App\Models\DataRanting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDataRantingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('data_ranting_create');
    }

    public function rules()
    {
        return [
            'nama_ketua' => [
                'string',
                'nullable',
            ],
            'kontak_hp_wa' => [
                'string',
                'nullable',
            ],
            'jumlah_anggota' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'lampiran' => [
                'array',
            ],
        ];
    }
}
