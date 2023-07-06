@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.kontak.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.kontaks.store") }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="level_id" value="{{ Auth::user()->roles->pluck('id')[0] }}">
            <input type="hidden" name="prov" value="{{ Auth::user()->prov }}">
            <input type="hidden" name="kab" value="{{ Auth::user()->kab }}">
            <input type="hidden" name="kec" value="{{ Auth::user()->kec }}">
            <input type="hidden" name="desa" value="{{ Auth::user()->desa }}">
            <div class="form-group">
                <label for="contact_first_name">{{ trans('cruds.kontak.fields.contact_first_name') }}</label>
                <input class="form-control {{ $errors->has('contact_first_name') ? 'is-invalid' : '' }}" type="text" name="contact_first_name" id="contact_first_name" value="{{ old('contact_first_name', '') }}">
                @if($errors->has('contact_first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_first_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kontak.fields.contact_first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_last_name">{{ trans('cruds.kontak.fields.contact_last_name') }}</label>
                <input class="form-control {{ $errors->has('contact_last_name') ? 'is-invalid' : '' }}" type="text" name="contact_last_name" id="contact_last_name" value="{{ old('contact_last_name', '') }}">
                @if($errors->has('contact_last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kontak.fields.contact_last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_phone_1">{{ trans('cruds.kontak.fields.contact_phone_1') }}</label>
                <input class="form-control {{ $errors->has('contact_phone_1') ? 'is-invalid' : '' }}" type="text" name="contact_phone_1" id="contact_phone_1" value="{{ old('contact_phone_1', '') }}">
                @if($errors->has('contact_phone_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_phone_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kontak.fields.contact_phone_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_phone_2">{{ trans('cruds.kontak.fields.contact_phone_2') }}</label>
                <input class="form-control {{ $errors->has('contact_phone_2') ? 'is-invalid' : '' }}" type="text" name="contact_phone_2" id="contact_phone_2" value="{{ old('contact_phone_2', '') }}">
                @if($errors->has('contact_phone_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_phone_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kontak.fields.contact_phone_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_email">{{ trans('cruds.kontak.fields.contact_email') }}</label>
                <input class="form-control {{ $errors->has('contact_email') ? 'is-invalid' : '' }}" type="text" name="contact_email" id="contact_email" value="{{ old('contact_email', '') }}">
                @if($errors->has('contact_email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kontak.fields.contact_email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_skype">{{ trans('cruds.kontak.fields.contact_skype') }}</label>
                <input class="form-control {{ $errors->has('contact_skype') ? 'is-invalid' : '' }}" type="text" name="contact_skype" id="contact_skype" value="{{ old('contact_skype', '') }}">
                @if($errors->has('contact_skype'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_skype') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kontak.fields.contact_skype_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_address">{{ trans('cruds.kontak.fields.contact_address') }}</label>
                <input class="form-control {{ $errors->has('contact_address') ? 'is-invalid' : '' }}" type="text" name="contact_address" id="contact_address" value="{{ old('contact_address', '') }}">
                @if($errors->has('contact_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kontak.fields.contact_address_helper') }}</span>
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