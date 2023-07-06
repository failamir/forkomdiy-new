@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.dataKerjaSama.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.data-kerja-samas.store") }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="level_id" value="{{ Auth::user()->roles->pluck('id')[0] }}">
            <input type="hidden" name="prov" value="{{ Auth::user()->prov }}">
            <input type="hidden" name="kab" value="{{ Auth::user()->kab }}">
            <input type="hidden" name="kec" value="{{ Auth::user()->kec }}">
            <input type="hidden" name="desa" value="{{ Auth::user()->desa }}">
            <div class="form-group">
                <label for="nama_stakeholder">{{ trans('cruds.dataKerjaSama.fields.nama_stakeholder') }}</label>
                <input class="form-control {{ $errors->has('nama_stakeholder') ? 'is-invalid' : '' }}" type="text" name="nama_stakeholder" id="nama_stakeholder" value="{{ old('nama_stakeholder', '') }}">
                @if($errors->has('nama_stakeholder'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_stakeholder') }}
                    </div>
                @endif
                <span class="help-block" style="font-size:12px">{{ trans('cruds.dataKerjaSama.fields.nama_stakeholder_helper') }}</span><br><br>
            </div>
            <div class="form-group">
                <label for="jangkauan_kerjasama">{{ trans('cruds.dataKerjaSama.fields.jangkauan_kerjasama') }}</label>
                <input class="form-control {{ $errors->has('jangkauan_kerjasama') ? 'is-invalid' : '' }}" type="text" name="jangkauan_kerjasama" id="jangkauan_kerjasama" value="{{ old('jangkauan_kerjasama', '') }}">
                @if($errors->has('jangkauan_kerjasama'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jangkauan_kerjasama') }}
                    </div>
                @endif
                <span class="help-block" style="font-size:12px">{{ trans('cruds.dataKerjaSama.fields.jangkauan_kerjasama_helper') }}</span><br><br>
            </div>
            <div class="form-group">
                <label for="lampiran">{{ trans('cruds.dataKerjaSama.fields.lampiran') }}</label>
                <div class="needsclick dropzone {{ $errors->has('lampiran') ? 'is-invalid' : '' }}" id="lampiran-dropzone">
                </div>
                @if($errors->has('lampiran'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lampiran') }}
                    </div>
                @endif
                <span class="help-block" style="font-size:12px">{{ trans('cruds.dataKerjaSama.fields.lampiran_helper') }}</span><br><br>
            </div>
            <div class="form-group">
                <label for="jenis_kerjasama">{{ trans('cruds.dataKerjaSama.fields.jenis_kerjasama') }}</label>
                <input class="form-control {{ $errors->has('jenis_kerjasama') ? 'is-invalid' : '' }}" type="text" name="jenis_kerjasama" id="jenis_kerjasama" value="{{ old('jenis_kerjasama', '') }}">
                @if($errors->has('jenis_kerjasama'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jenis_kerjasama') }}
                    </div>
                @endif
                <span class="help-block" style="font-size:12px">{{ trans('cruds.dataKerjaSama.fields.jenis_kerjasama_helper') }}</span><br><br>
            </div>
            <div class="form-group">
                <label for="mulai_kerjasama">{{ trans('cruds.dataKerjaSama.fields.mulai_kerjasama') }}</label>
                <input class="form-control date {{ $errors->has('mulai_kerjasama') ? 'is-invalid' : '' }}" type="text" name="mulai_kerjasama" id="mulai_kerjasama" value="{{ old('mulai_kerjasama') }}">
                @if($errors->has('mulai_kerjasama'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mulai_kerjasama') }}
                    </div>
                @endif
                <span class="help-block" style="font-size:12px">{{ trans('cruds.dataKerjaSama.fields.mulai_kerjasama_helper') }}</span><br><br>
            </div>
            <div class="form-group">
                <label for="frekuensi_kerjasama">{{ trans('cruds.dataKerjaSama.fields.frekuensi_kerjasama') }}</label>
                <input class="form-control {{ $errors->has('frekuensi_kerjasama') ? 'is-invalid' : '' }}" type="text" name="frekuensi_kerjasama" id="frekuensi_kerjasama" value="{{ old('frekuensi_kerjasama', '') }}">
                @if($errors->has('frekuensi_kerjasama'))
                    <div class="invalid-feedback">
                        {{ $errors->first('frekuensi_kerjasama') }}
                    </div>
                @endif
                <span class="help-block" style="font-size:12px">{{ trans('cruds.dataKerjaSama.fields.frekuensi_kerjasama_helper') }}</span><br><br>
            </div>
            <div class="form-group">
                <label for="no_hp_wa_lembaga">{{ trans('cruds.dataKerjaSama.fields.no_hp_wa_lembaga') }}</label>
                <input class="form-control {{ $errors->has('no_hp_wa_lembaga') ? 'is-invalid' : '' }}" type="text" name="no_hp_wa_lembaga" id="no_hp_wa_lembaga" value="{{ old('no_hp_wa_lembaga', '') }}">
                @if($errors->has('no_hp_wa_lembaga'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_hp_wa_lembaga') }}
                    </div>
                @endif
                <span class="help-block" style="font-size:12px">{{ trans('cruds.dataKerjaSama.fields.no_hp_wa_lembaga_helper') }}</span><br><br>
            </div>
            <div class="form-group">
                <label for="kontak_di_lembaga">{{ trans('cruds.dataKerjaSama.fields.kontak_di_lembaga') }}</label>
                <input class="form-control {{ $errors->has('kontak_di_lembaga') ? 'is-invalid' : '' }}" type="text" name="kontak_di_lembaga" id="kontak_di_lembaga" value="{{ old('kontak_di_lembaga', '') }}">
                @if($errors->has('kontak_di_lembaga'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kontak_di_lembaga') }}
                    </div>
                @endif
                <span class="help-block" style="font-size:12px">{{ trans('cruds.dataKerjaSama.fields.kontak_di_lembaga_helper') }}</span><br><br>
            </div>
            <div class="form-group">
                <label for="no_hp_wa_stakeholder">{{ trans('cruds.dataKerjaSama.fields.no_hp_wa_stakeholder') }}</label>
                <input class="form-control {{ $errors->has('no_hp_wa_stakeholder') ? 'is-invalid' : '' }}" type="text" name="no_hp_wa_stakeholder" id="no_hp_wa_stakeholder" value="{{ old('no_hp_wa_stakeholder', '') }}">
                @if($errors->has('no_hp_wa_stakeholder'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_hp_wa_stakeholder') }}
                    </div>
                @endif
                <span class="help-block" style="font-size:12px">{{ trans('cruds.dataKerjaSama.fields.no_hp_wa_stakeholder_helper') }}</span><br><br>
            </div>
            <div class="form-group">
                <label for="nama_lembaga_kerjasama">{{ trans('cruds.dataKerjaSama.fields.nama_lembaga_kerjasama') }}</label>
                <input class="form-control {{ $errors->has('nama_lembaga_kerjasama') ? 'is-invalid' : '' }}" type="text" name="nama_lembaga_kerjasama" id="nama_lembaga_kerjasama" value="{{ old('nama_lembaga_kerjasama', '') }}">
                @if($errors->has('nama_lembaga_kerjasama'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_lembaga_kerjasama') }}
                    </div>
                @endif
                <span class="help-block" style="font-size:12px">{{ trans('cruds.dataKerjaSama.fields.nama_lembaga_kerjasama_helper') }}</span><br><br>
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
    url: '{{ route('admin.data-kerja-samas.storeMedia') }}',
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
@if(isset($dataKerjaSama) && $dataKerjaSama->lampiran)
          var files =
            {!! json_encode($dataKerjaSama->lampiran) !!}
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