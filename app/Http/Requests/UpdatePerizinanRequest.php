<?php

namespace App\Http\Requests;

use App\Models\Perizinan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePerizinanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('perizinan_edit');
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
        ];
    }
}
