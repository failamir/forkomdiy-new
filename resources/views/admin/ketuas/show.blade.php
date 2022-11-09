@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ketua.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ketuas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ketua.fields.id') }}
                        </th>
                        <td>
                            {{ $ketua->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ketua.fields.periode') }}
                        </th>
                        <td>
                            {{ $ketua->periode }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ketua.fields.name') }}
                        </th>
                        <td>
                            {{ $ketua->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.ketuas.index') }}">
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
            <a class="nav-link" href="#ketua_data_lembagas" role="tab" data-toggle="tab">
                {{ trans('cruds.dataLembaga.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="ketua_data_lembagas">
            @includeIf('admin.ketuas.relationships.ketuaDataLembagas', ['dataLembagas' => $ketua->ketuaDataLembagas])
        </div>
    </div>
</div>

@endsection