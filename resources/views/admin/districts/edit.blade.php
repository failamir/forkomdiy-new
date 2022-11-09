@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.district.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.districts.update", [$district->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="id_regency">{{ trans('cruds.district.fields.id_regency') }}</label>
                <input class="form-control {{ $errors->has('id_regency') ? 'is-invalid' : '' }}" type="text" name="id_regency" id="id_regency" value="{{ old('id_regency', $district->id_regency) }}">
                @if($errors->has('id_regency'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_regency') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.district.fields.id_regency_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="id_district">{{ trans('cruds.district.fields.id_district') }}</label>
                <input class="form-control {{ $errors->has('id_district') ? 'is-invalid' : '' }}" type="text" name="id_district" id="id_district" value="{{ old('id_district', $district->id_district) }}">
                @if($errors->has('id_district'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_district') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.district.fields.id_district_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="district_name">{{ trans('cruds.district.fields.district_name') }}</label>
                <input class="form-control {{ $errors->has('district_name') ? 'is-invalid' : '' }}" type="text" name="district_name" id="district_name" value="{{ old('district_name', $district->district_name) }}">
                @if($errors->has('district_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('district_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.district.fields.district_name_helper') }}</span>
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