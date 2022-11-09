<?php

namespace App\Http\Requests;

use App\Models\DataKerjaSama;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDataKerjaSamaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('data_kerja_sama_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:data_kerja_samas,id',
        ];
    }
}
