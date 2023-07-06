@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.village.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.villages.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="id_district">{{ trans('cruds.village.fields.id_district') }}</label>
                <input class="form-control {{ $errors->has('id_district') ? 'is-invalid' : '' }}" type="text" name="id_district" id="id_district" value="{{ old('id_district', '') }}">
                @if($errors->has('id_district'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_district') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.village.fields.id_district_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="id_village">{{ trans('cruds.village.fields.id_village') }}</label>
                <input class="form-control {{ $errors->has('id_village') ? 'is-invalid' : '' }}" type="text" name="id_village" id="id_village" value="{{ old('id_village', '') }}">
                @if($errors->has('id_village'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_village') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.village.fields.id_village_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="village_name">{{ trans('cruds.village.fields.village_name') }}</label>
                <input class="form-control {{ $errors->has('village_name') ? 'is-invalid' : '' }}" type="text" name="village_name" id="village_name" value="{{ old('village_name', '') }}">
                @if($errors->has('village_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('village_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.village.fields.village_name_helper') }}</span>
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