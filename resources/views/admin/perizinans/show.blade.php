@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.perizinan.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.perizinans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.perizinan.fields.id') }}
                        </th>
                        <td>
                            {{ $perizinan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.perizinan.fields.instansi_penerbit') }}
                        </th>
                        <td>
                            {{ $perizinan->instansi_penerbit }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.perizinan.fields.nomor_izin') }}
                        </th>
                        <td>
                            {{ $perizinan->nomor_izin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.perizinan.fields.lampiran_file') }}
                        </th>
                        <td>
                            @foreach($perizinan->lampiran_file as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.perizinan.fields.nama_izin') }}
                        </th>
                        <td>
                            {{ $perizinan->nama_izin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.perizinan.fields.tanggal_dikeluarkan') }}
                        </th>
                        <td>
                            {{ $perizinan->tanggal_dikeluarkan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.perizinan.fields.berlaku_sampai') }}
                        </th>
                        <td>
                            {{ $perizinan->berlaku_sampai }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.perizinans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#perizinan_data_lembagas" role="tab" data-toggle="tab">
                {{ trans('cruds.dataLembaga.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="perizinan_data_lembagas">
            @includeIf('admin.perizinans.relationships.perizinanDataLembagas', ['dataLembagas' => $perizinan->perizinanDataLembagas])
        </div>
    </div>
</div>

@endsection