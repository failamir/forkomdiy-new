@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dataDaerah.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.data-daerahs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dataDaerah.fields.id') }}
                        </th>
                        <td>
                            {{ $dataDaerah->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataDaerah.fields.regency') }}
                        </th>
                        <td>
                            {{ $dataDaerah->regency->regency_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataDaerah.fields.nama_ketua') }}
                        </th>
                        <td>
                            {{ $dataDaerah->nama_ketua }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataDaerah.fields.kontak_hp_wa') }}
                        </th>
                        <td>
                            {{ $dataDaerah->kontak_hp_wa }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataDaerah.fields.jumlah_anggota') }}
                        </th>
                        <td>
                            {{ $dataDaerah->jumlah_anggota }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataDaerah.fields.lampiran') }}
                        </th>
                        <td>
                            @foreach($dataDaerah->lampiran as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.data-daerahs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection