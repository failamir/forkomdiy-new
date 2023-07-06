@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.village.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.villages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.village.fields.id') }}
                        </th>
                        <td>
                            {{ $village->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.village.fields.id_district') }}
                        </th>
                        <td>
                            {{ $village->id_district }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.village.fields.id_village') }}
                        </th>
                        <td>
                            {{ $village->id_village }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.village.fields.village_name') }}
                        </th>
                        <td>
                            {{ $village->village_name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.villages.index') }}">
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
            <a class="nav-link" href="#village_data_rantings" role="tab" data-toggle="tab">
                {{ trans('cruds.dataRanting.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="village_data_rantings">
            @includeIf('admin.villages.relationships.villageDataRantings', ['dataRantings' => $village->villageDataRantings])
        </div>
    </div>
</div>

@endsection