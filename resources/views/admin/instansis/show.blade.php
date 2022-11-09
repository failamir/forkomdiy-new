@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.instansi.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.instansis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.instansi.fields.id') }}
                        </th>
                        <td>
                            {{ $instansi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instansi.fields.company_name') }}
                        </th>
                        <td>
                            {{ $instansi->company_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instansi.fields.company_address') }}
                        </th>
                        <td>
                            {{ $instansi->company_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instansi.fields.company_website') }}
                        </th>
                        <td>
                            {{ $instansi->company_website }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.instansi.fields.company_email') }}
                        </th>
                        <td>
                            {{ $instansi->company_email }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.instansis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection