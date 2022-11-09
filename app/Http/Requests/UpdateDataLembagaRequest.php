<?php

namespace App\Http\Requests;

use App\Models\DataLembaga;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDataLembagaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('data_lembaga_edit');
    }

    public function rules()
    {
        return [
            'nama_lembaga' => [
                'string',
                'nullable',
            ],
            'sekretariat_wilayah' => [
                'string',
                'nullable',
            ],
            'website' => [
                'string',
                'nullable',
            ],
            'email' => [
                'string',
                'nullable',
            ],
            'telp' => [
                'string',
                'nullable',
            ],
            'whats_app' => [
                'string',
                'nullable',
            ],
            'lingkup_kegiatan' => [
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
