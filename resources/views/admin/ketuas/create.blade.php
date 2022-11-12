@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.ketua.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ketuas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="periode">{{ trans('cruds.ketua.fields.periode') }}</label>
                <input class="form-control {{ $errors->has('periode') ? 'is-invalid' : '' }}" type="text" name="periode" id="periode" value="{{ old('periode', '') }}">
                @if($errors->has('periode'))
                    <div class="invalid-feedback">
                        {{ $errors->first('periode') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ketua.fields.periode_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kontak_id">{{ trans('cruds.ketua.fields.kontak') }}</label>
                <select class="form-control select2 {{ $errors->has('kontak') ? 'is-invalid' : '' }}" name="kontak_id" id="kontak_id">
                    @foreach($kontaks as $id => $entry)
                        <option value="{{ $id }}" {{ old('kontak_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('kontak'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kontak') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ketua.fields.kontak_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.ketua.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ketua.fields.name_helper') }}</span>
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