<?php

namespace App\Http\Requests;

use App\Models\DataCabang;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDataCabangRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('data_cabang_create');
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
