@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.province.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.provinces.update", [$province->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="province_name">{{ trans('cruds.province.fields.province_name') }}</label>
                <input class="form-control {{ $errors->has('province_name') ? 'is-invalid' : '' }}" type="text" name="province_name" id="province_name" value="{{ old('province_name', $province->province_name) }}">
                @if($errors->has('province_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('province_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.province.fields.province_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="id_province">{{ trans('cruds.province.fields.id_province') }}</label>
                <input class="form-control {{ $errors->has('id_province') ? 'is-invalid' : '' }}" type="text" name="id_province" id="id_province" value="{{ old('id_province', $province->id_province) }}">
                @if($errors->has('id_province'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_province') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.province.fields.id_province_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection