@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dataRanting.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.data-rantings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dataRanting.fields.id') }}
                        </th>
                        <td>
                            {{ $dataRanting->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataRanting.fields.village') }}
                        </th>
                        <td>
                            {{ $dataRanting->village->village_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataRanting.fields.nama_ketua') }}
                        </th>
                        <td>
                            {{ $dataRanting->nama_ketua }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataRanting.fields.kontak_hp_wa') }}
                        </th>
                        <td>
                            {{ $dataRanting->kontak_hp_wa }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataRanting.fields.jumlah_anggota') }}
                        </th>
                        <td>
                            {{ $dataRanting->jumlah_anggota }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dataRanting.fields.lampiran') }}
                        </th>
                        <td>
                            @foreach($dataRanting->lampiran as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.data-rantings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection