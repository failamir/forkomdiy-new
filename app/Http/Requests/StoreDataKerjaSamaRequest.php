<?php

namespace App\Http\Requests;

use App\Models\DataKerjaSama;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDataKerjaSamaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('data_kerja_sama_create');
    }

    public function rules()
    {
        return [
            'nama_stakeholder' => [
                'string',
                'nullable',
            ],
            'jangkauan_kerjasama' => [
                'string',
                'nullable',
            ],
            'lampiran' => [
                'array',
            ],
            'jenis_kerjasama' => [
                'string',
                'nullable',
            ],
            'mulai_kerjasama' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'frekuensi_kerjasama' => [
                'string',
                'nullable',
            ],
            'no_hp_wa_lembaga' => [
                'string',
                'nullable',
            ],
            'kontak_di_lembaga' => [
                'string',
                'nullable',
            ],
            'no_hp_wa_stakeholder' => [
                'string',
                'nullable',
            ],
            'nama_lembaga_kerjasama' => [
                'string',
                'nullable',
            ],
        ];
    }
}
