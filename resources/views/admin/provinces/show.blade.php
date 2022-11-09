@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.province.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.provinces.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.province.fields.id') }}
                        </th>
                        <td>
                            {{ $province->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.province.fields.province_name') }}
                        </th>
                        <td>
                            {{ $province->province_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.province.fields.id_province') }}
                        </th>
                        <td>
                            {{ $province->id_province }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.provinces.index') }}">
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
            <a class="nav-link" href="#provinsi_data_lembagas" role="tab" data-toggle="tab">
                {{ trans('cruds.dataLembaga.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="provinsi_data_lembagas">
            @includeIf('admin.provinces.relationships.provinsiDataLembagas', ['dataLembagas' => $province->provinsiDataLembagas])
        </div>
    </div>
</div>

@endsection