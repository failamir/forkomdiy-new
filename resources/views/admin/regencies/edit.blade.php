@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.regency.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.regencies.update", [$regency->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="id_province">{{ trans('cruds.regency.fields.id_province') }}</label>
                <input class="form-control {{ $errors->has('id_province') ? 'is-invalid' : '' }}" type="text" name="id_province" id="id_province" value="{{ old('id_province', $regency->id_province) }}">
                @if($errors->has('id_province'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_province') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.regency.fields.id_province_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="id_regency">{{ trans('cruds.regency.fields.id_regency') }}</label>
                <input class="form-control {{ $errors->has('id_regency') ? 'is-invalid' : '' }}" type="text" name="id_regency" id="id_regency" value="{{ old('id_regency', $regency->id_regency) }}">
                @if($errors->has('id_regency'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_regency') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.regency.fields.id_regency_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="regency_name">{{ trans('cruds.regency.fields.regency_name') }}</label>
                <input class="form-control {{ $errors->has('regency_name') ? 'is-invalid' : '' }}" type="text" name="regency_name" id="regency_name" value="{{ old('regency_name', $regency->regency_name) }}">
                @if($errors->has('regency_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('regency_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.regency.fields.regency_name_helper') }}</span>
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