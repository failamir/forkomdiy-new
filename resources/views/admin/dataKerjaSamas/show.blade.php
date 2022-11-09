@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dataKerjaSama.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.data-kerja-samas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.id') }}
                        </th>
                        <td>
                            {{ $dataKerjaSama->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.nama_stakeholder') }}
                        </th>
                        <td>
                            {{ $dataKerjaSama->nama_stakeholder }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.jangkauan_kerjasama') }}
                        </th>
                        <td>
                            {{ $dataKerjaSama->jangkauan_kerjasama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.lampiran') }}
                        </th>
                        <td>
                            @foreach($dataKerjaSama->lampiran as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.jenis_kerjasama') }}
                        </th>
                        <td>
                            {{ $dataKerjaSama->jenis_kerjasama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.mulai_kerjasama') }}
                        </th>
                        <td>
                            {{ $dataKerjaSama->mulai_kerjasama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.frekuensi_kerjasama') }}
                        </th>
                        <td>
                            {{ $dataKerjaSama->frekuensi_kerjasama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.no_hp_wa_lembaga') }}
                        </th>
                        <td>
                            {{ $dataKerjaSama->no_hp_wa_lembaga }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.kontak_di_lembaga') }}
                        </th>
                        <td>
                            {{ $dataKerjaSama->kontak_di_lembaga }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.no_hp_wa_stakeholder') }}
                        </th>
                        <td>
                            {{ $dataKerjaSama->no_hp_wa_stakeholder }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.nama_lembaga_kerjasama') }}
                        </th>
                        <td>
                            {{ $dataKerjaSama->nama_lembaga_kerjasama }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.data-kerja-samas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection