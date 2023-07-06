@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.kontak.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kontaks.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.kontak.fields.id') }}
                        </th>
                        <td>
                            {{ $kontak->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kontak.fields.contact_first_name') }}
                        </th>
                        <td>
                            {{ $kontak->contact_first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kontak.fields.contact_last_name') }}
                        </th>
                        <td>
                            {{ $kontak->contact_last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kontak.fields.contact_phone_1') }}
                        </th>
                        <td>
                            {{ $kontak->contact_phone_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kontak.fields.contact_phone_2') }}
                        </th>
                        <td>
                            {{ $kontak->contact_phone_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kontak.fields.contact_email') }}
                        </th>
                        <td>
                            {{ $kontak->contact_email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kontak.fields.contact_skype') }}
                        </th>
                        <td>
                            {{ $kontak->contact_skype }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kontak.fields.contact_address') }}
                        </th>
                        <td>
                            {{ $kontak->contact_address }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.kontaks.index') }}">
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
            <a class="nav-link" href="#kontak_ketuas" role="tab" data-toggle="tab">
                {{ trans('cruds.ketua.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="kontak_ketuas">
            @includeIf('admin.kontaks.relationships.kontakKetuas', ['ketuas' => $kontak->kontakKetuas])
        </div>
    </div>
</div>

@endsection