@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dataCabang.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.data-cabangs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dataCabang.fields.id') }}
                        </th>
                        <td>
                            {{ $dataCabang->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataCabang.fields.district') }}
                        </th>
                        <td>
                            {{ $dataCabang->district->district_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataCabang.fields.nama_ketua') }}
                        </th>
                        <td>
                            {{ $dataCabang->nama_ketua }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataCabang.fields.kontak_hp_wa') }}
                        </th>
                        <td>
                            {{ $dataCabang->kontak_hp_wa }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataCabang.fields.jumlah_anggota') }}
                        </th>
                        <td>
                            {{ $dataCabang->jumlah_anggota }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataCabang.fields.lampiran') }}
                        </th>
                        <td>
                            @foreach($dataCabang->lampiran as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.data-cabangs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection