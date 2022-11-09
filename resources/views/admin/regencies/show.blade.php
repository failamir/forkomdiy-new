@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.regency.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.regencies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.regency.fields.id') }}
                        </th>
                        <td>
                            {{ $regency->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.regency.fields.id_province') }}
                        </th>
                        <td>
                            {{ $regency->id_province }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.regency.fields.id_regency') }}
                        </th>
                        <td>
                            {{ $regency->id_regency }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.regency.fields.regency_name') }}
                        </th>
                        <td>
                            {{ $regency->regency_name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.regencies.index') }}">
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
            <a class="nav-link" href="#regency_data_daerahs" role="tab" data-toggle="tab">
                {{ trans('cruds.dataDaerah.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="regency_data_daerahs">
            @includeIf('admin.regencies.relationships.regencyDataDaerahs', ['dataDaerahs' => $regency->regencyDataDaerahs])
        </div>
    </div>
</div>

@endsection