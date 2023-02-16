@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.users.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('approved') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="approved" value="0">
                    <input class="form-check-input" type="checkbox" name="approved" id="approved" value="1" {{ old('approved', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="approved">{{ trans('cruds.user.fields.approved') }}</label>
                </div>
                @if($errors->has('approved'))
                    <div class="invalid-feedback">
                        {{ $errors->first('approved') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.approved_helper') }}</span>
            </div>
            {{-- <div class="form-group">
                <label>{{ trans('cruds.user.fields.level') }}</label>
                <select class="form-control {{ $errors->has('level') ? 'is-invalid' : '' }}" name="level" id="level">
                    <option value disabled {{ old('level', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\User::LEVEL_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('level', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('level'))
                    <div class="invalid-feedback">
                        {{ $errors->first('level') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.level_helper') }}</span>
            </div> --}}
            <div class="form-group">
                <label for="kab">{{ 'Provinsi' }}</label>
                <select name="prov" class="form-control" id="provinsi">
                    <option value=''>Pilih Provinsi</option>
                </select>
            </div>
            <div class="form-group">
                <label for="kab">{{ trans('Kabupaten') }}</label>
                <select name="kab" class="form-control" id="kabupaten">
                    <option value=''>Pilih Kabupaten</option>
                </select>
            </div>
            <div class="form-group">
                <label for="kec">{{ trans('Kecamatan') }}</label>
                <select name="kec" class="form-control" id="kecamatan">
                    <option value=''>Pilih Kecamatan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="desa">{{ trans('Desa') }}</label>
                <select name="desa" class="form-control" id="desa">
                    <option value=''>Pilih Desa</option>
                </select>
            </div>
            <div class="form-group">
                <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                    @foreach($roles as $id => $role)
                        <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $role }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <div class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="team_id">{{ trans('cruds.user.fields.team') }}</label>
                @if (Auth::id()!= 1)
                    : {{Auth::user()->team->name}}
                @else
                <select class="form-control select2 {{ $errors->has('team') ? 'is-invalid' : '' }}" name="team_id" id="team_id">
                    @foreach($teams as $id => $entry)
                        <option value="{{ $id }}" {{ old('team_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @endif
                @if($errors->has('team'))
                    <div class="invalid-feedback">
                        {{ $errors->first('team') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.team_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function(){
        $("#provinsi").ready(function (){
            var url = "<?php echo url('admin/wilayah/add_ajax_pro');?>";
            $('#provinsi').load(url);
            return false;
        })

        $("#kabupaten").ready(function (){
            var url = "<?php echo url('admin/wilayah/add_ajax_kab');?>/"+34;
            $('#kabupaten').load(url);
            return false;
        })

        $("#provinsi").change(function (){
            var url = "<?php echo url('admin/wilayah/add_ajax_kab');?>/"+$(this).val();
            $('#kabupaten').load(url);
            console.log($(this).val());
            return false;
        })
        
        $("#kabupaten").change(function (){
            var url = "<?php echo url('admin/wilayah/add_ajax_kec');?>/"+$(this).val();
            $('#kecamatan').load(url);
            console.log($(this).val());
            return false;
        })
        
        $("#kecamatan").change(function (){
            var url = "<?php echo url('admin/wilayah/add_ajax_des');?>/"+$(this).val();
            $('#desa').load(url);
            console.log($(this).val());
            return false;
        })
    });
</script>
@endsection