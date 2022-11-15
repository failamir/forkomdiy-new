@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.dataLembaga.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.data-lembagas.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped" style="font-size:140%">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.dataLembaga.fields.id') }}
                            </th>
                            <td>
                                {{ $dataLembaga->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataLembaga.fields.nama_lembaga') }}
                            </th>
                            <td>
                                {{ $dataLembaga->nama_lembaga }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataLembaga.fields.singkatan') }}
                            </th>
                            <td>
                                {{ $dataLembaga->singkatan }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataLembaga.fields.ketua') }}
                            </th>
                            <td>
                                {{ $dataLembaga->ketua->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataLembaga.fields.sekretariat_wilayah') }}
                            </th>
                            <td>
                                {{ $dataLembaga->sekretariat_wilayah }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataLembaga.fields.website') }}
                            </th>
                            <td>
                                {{ $dataLembaga->website }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataLembaga.fields.email') }}
                            </th>
                            <td>
                                {{ $dataLembaga->email }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataLembaga.fields.telp') }}
                            </th>
                            <td>
                                {{ $dataLembaga->telp }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataLembaga.fields.whats_app') }}
                            </th>
                            <td>
                                {{ $dataLembaga->whats_app }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataLembaga.fields.lingkup_kegiatan') }}
                            </th>
                            <td>
                                {{ $dataLembaga->lingkup_kegiatan }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataLembaga.fields.perizinan') }}
                            </th>
                            <td>
                                {{ $dataLembaga->perizinan->nama_izin ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataLembaga.fields.jumlah_anggota') }}
                            </th>
                            <td>
                                {{ $dataLembaga->jumlah_anggota }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataLembaga.fields.lampiran') }}
                            </th>
                            <td>
                                @foreach ($dataLembaga->lampiran as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.dataLembaga.fields.provinsi') }}
                            </th>
                            <td>
                                {{ $dataLembaga->provinsi->province_name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                List Data Daerah
                            </td>
                            <td>
                                @php
                                    $DataDaerah = \App\Models\DataDaerah::with('regency')
                                        ->where('team_id', Auth::user()->team_id)
                                        ->get();
                                @endphp
                                @foreach ($DataDaerah as $item)
                                    <a style="font-size:90%" href="{{ route('admin.data-daerahs.show', $item->id) }}"
                                        class="btn btn-xs btn-primary">{{ $item->regency->regency_name }}
                                    - {{ 'Ketua : ' .$item->nama_ketua }}</a>
                                    </a> <br>
                                    {{-- @dump($DataDaerah) --}}
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>
                                List Data Cabang
                            </td>

                            <td>
                                @php
                                    $DataCabang = \App\Models\DataCabang::with('district')
                                        ->where('team_id', Auth::user()->team_id)
                                        ->get();
                                @endphp
                                @foreach ($DataCabang as $item)
                                    <a style="font-size: 90%" href="{{ route('admin.data-cabangs.show', $item->id) }}"
                                        class="btn btn-xs btn-primary">{{ $item->district->district_name }}
                                    - {{ 'Ketua : ' .$item->nama_ketua }}</a>
                                    </a> <br>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td>
                                List Data Ranting
                            </td>

                            <td>
                                @php
                                    $DataRanting = \App\Models\DataRanting::with('village')
                                        ->where('team_id', Auth::user()->team_id)
                                        ->get();
                                @endphp
                                @foreach ($DataRanting as $item)
                                <a style="font-size: 90%" href="{{ route('admin.data-rantings.show', $item->id) }}"
                                        class="btn btn-xs btn-primary">{{ $item->village->village_name }}
                                        - {{ 'Ketua : ' .$item->nama_ketua }}</a>
                                    </a> <br>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.data-lembagas.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
