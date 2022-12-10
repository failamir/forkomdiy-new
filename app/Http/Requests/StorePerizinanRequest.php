<?php

namespace App\Http\Requests;

use App\Models\Perizinan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePerizinanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('perizinan_create');
    }

    public function rules()
    {
        return [
            'instansi_penerbit' => [
                'string',
                'nullable',
            ],
            'nomor_izin' => [
                'string',
                'nullable',
            ],
            'lampiran_file' => [
                'array',
            ],
            'nama_izin' => [
                'string',
                'nullable',
            ],
            'tanggal_dikeluarkan' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'berlaku_sampai' => [
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
