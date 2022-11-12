@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.dataLembaga.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.data-lembagas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama_lembaga">{{ trans('cruds.dataLembaga.fields.nama_lembaga') }}</label>
                <input class="form-control {{ $errors->has('nama_lembaga') ? 'is-invalid' : '' }}" type="text" name="nama_lembaga" id="nama_lembaga" value="{{ old('nama_lembaga', '') }}">
                @if($errors->has('nama_lembaga'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_lembaga') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataLembaga.fields.nama_lembaga_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="singkatan">{{ trans('cruds.dataLembaga.fields.singkatan') }}</label>
                <input class="form-control {{ $errors->has('singkatan') ? 'is-invalid' : '' }}" type="text" name="singkatan" id="singkatan" value="{{ old('singkatan', '') }}">
                @if($errors->has('singkatan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('singkatan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataLembaga.fields.singkatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ketua_id">{{ trans('cruds.dataLembaga.fields.ketua') }}</label>
                <select class="form-control select2 {{ $errors->has('ketua') ? 'is-invalid' : '' }}" name="ketua_id" id="ketua_id">
                    @foreach($ketuas as $id => $entry)
                        <option value="{{ $id }}" {{ old('ketua_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ketua'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ketua') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataLembaga.fields.ketua_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sekretariat_wilayah">{{ trans('cruds.dataLembaga.fields.sekretariat_wilayah') }}</label>
                <input class="form-control {{ $errors->has('sekretariat_wilayah') ? 'is-invalid' : '' }}" type="text" name="sekretariat_wilayah" id="sekretariat_wilayah" value="{{ old('sekretariat_wilayah', '') }}">
                @if($errors->has('sekretariat_wilayah'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sekretariat_wilayah') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataLembaga.fields.sekretariat_wilayah_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="website">{{ trans('cruds.dataLembaga.fields.website') }}</label>
                <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', '') }}">
                @if($errors->has('website'))
                    <div class="invalid-feedback">
                        {{ $errors->first('website') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataLembaga.fields.website_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.dataLembaga.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataLembaga.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="telp">{{ trans('cruds.dataLembaga.fields.telp') }}</label>
                <input class="form-control {{ $errors->has('telp') ? 'is-invalid' : '' }}" type="text" name="telp" id="telp" value="{{ old('telp', '') }}">
                @if($errors->has('telp'))
                    <div class="invalid-feedback">
                        {{ $errors->first('telp') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataLembaga.fields.telp_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="whats_app">{{ trans('cruds.dataLembaga.fields.whats_app') }}</label>
                <input class="form-control {{ $errors->has('whats_app') ? 'is-invalid' : '' }}" type="text" name="whats_app" id="whats_app" value="{{ old('whats_app', '') }}">
                @if($errors->has('whats_app'))
                    <div class="invalid-feedback">
                        {{ $errors->first('whats_app') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataLembaga.fields.whats_app_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lingkup_kegiatan">{{ trans('cruds.dataLembaga.fields.lingkup_kegiatan') }}</label>
                <input class="form-control {{ $errors->has('lingkup_kegiatan') ? 'is-invalid' : '' }}" type="text" name="lingkup_kegiatan" id="lingkup_kegiatan" value="{{ old('lingkup_kegiatan', '') }}">
                @if($errors->has('lingkup_kegiatan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lingkup_kegiatan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataLembaga.fields.lingkup_kegiatan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="perizinan_id">{{ trans('cruds.dataLembaga.fields.perizinan') }}</label>
                <select class="form-control select2 {{ $errors->has('perizinan') ? 'is-invalid' : '' }}" name="perizinan_id" id="perizinan_id">
                    @foreach($perizinans as $id => $entry)
                        <option value="{{ $id }}" {{ old('perizinan_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('perizinan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('perizinan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataLembaga.fields.perizinan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="jumlah_anggota">{{ trans('cruds.dataLembaga.fields.jumlah_anggota') }}</label>
                <input class="form-control {{ $errors->has('jumlah_anggota') ? 'is-invalid' : '' }}" type="number" name="jumlah_anggota" id="jumlah_anggota" value="{{ old('jumlah_anggota', '10') }}" step="1">
                @if($errors->has('jumlah_anggota'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jumlah_anggota') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataLembaga.fields.jumlah_anggota_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lampiran">{{ trans('cruds.dataLembaga.fields.lampiran') }}</label>
                <div class="needsclick dropzone {{ $errors->has('lampiran') ? 'is-invalid' : '' }}" id="lampiran-dropzone">
                </div>
                @if($errors->has('lampiran'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lampiran') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataLembaga.fields.lampiran_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="provinsi_id">{{ trans('cruds.dataLembaga.fields.provinsi') }}</label>
                <select class="form-control select2 {{ $errors->has('provinsi') ? 'is-invalid' : '' }}" name="provinsi_id" id="provinsi_id">
                    @foreach($provinsis as $id => $entry)
                        <option value="{{ $id }}" {{ old('provinsi_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('provinsi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('provinsi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataLembaga.fields.provinsi_helper') }}</span>
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
    var uploadedLampiranMap = {}
Dropzone.options.lampiranDropzone = {
    url: '{{ route('admin.data-lembagas.storeMedia') }}',
    maxFilesize: 52, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 52
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="lampiran[]" value="' + response.name + '">')
      uploadedLampiranMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedLampiranMap[file.name]
      }
      $('form').find('input[name="lampiran[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($dataLembaga) && $dataLembaga->lampiran)
          var files =
            {!! json_encode($dataLembaga->lampiran) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="lampiran[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection