@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.perizinan.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.perizinans.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="instansi_penerbit">{{ trans('cruds.perizinan.fields.instansi_penerbit') }}</label>
                <input class="form-control {{ $errors->has('instansi_penerbit') ? 'is-invalid' : '' }}" type="text" name="instansi_penerbit" id="instansi_penerbit" value="{{ old('instansi_penerbit', '') }}">
                @if($errors->has('instansi_penerbit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instansi_penerbit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.perizinan.fields.instansi_penerbit_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nomor_izin">{{ trans('cruds.perizinan.fields.nomor_izin') }}</label>
                <input class="form-control {{ $errors->has('nomor_izin') ? 'is-invalid' : '' }}" type="text" name="nomor_izin" id="nomor_izin" value="{{ old('nomor_izin', '') }}">
                @if($errors->has('nomor_izin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nomor_izin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.perizinan.fields.nomor_izin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lampiran_file">{{ trans('cruds.perizinan.fields.lampiran_file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('lampiran_file') ? 'is-invalid' : '' }}" id="lampiran_file-dropzone">
                </div>
                @if($errors->has('lampiran_file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lampiran_file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.perizinan.fields.lampiran_file_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_izin">{{ trans('cruds.perizinan.fields.nama_izin') }}</label>
                <input class="form-control {{ $errors->has('nama_izin') ? 'is-invalid' : '' }}" type="text" name="nama_izin" id="nama_izin" value="{{ old('nama_izin', '') }}">
                @if($errors->has('nama_izin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_izin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.perizinan.fields.nama_izin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tanggal_dikeluarkan">{{ trans('cruds.perizinan.fields.tanggal_dikeluarkan') }}</label>
                <input class="form-control date {{ $errors->has('tanggal_dikeluarkan') ? 'is-invalid' : '' }}" type="text" name="tanggal_dikeluarkan" id="tanggal_dikeluarkan" value="{{ old('tanggal_dikeluarkan') }}">
                @if($errors->has('tanggal_dikeluarkan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tanggal_dikeluarkan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.perizinan.fields.tanggal_dikeluarkan_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="berlaku_sampai">{{ trans('cruds.perizinan.fields.berlaku_sampai') }}</label>
                <input class="form-control {{ $errors->has('berlaku_sampai') ? 'is-invalid' : '' }}" type="text" name="berlaku_sampai" id="berlaku_sampai" value="{{ old('berlaku_sampai', '') }}">
                @if($errors->has('berlaku_sampai'))
                    <div class="invalid-feedback">
                        {{ $errors->first('berlaku_sampai') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.perizinan.fields.berlaku_sampai_helper') }}</span>
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
    var uploadedLampiranFileMap = {}
Dropzone.options.lampiranFileDropzone = {
    url: '{{ route('admin.perizinans.storeMedia') }}',
    maxFilesize: 20, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="lampiran_file[]" value="' + response.name + '">')
      uploadedLampiranFileMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedLampiranFileMap[file.name]
      }
      $('form').find('input[name="lampiran_file[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($perizinan) && $perizinan->lampiran_file)
          var files =
            {!! json_encode($perizinan->lampiran_file) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="lampiran_file[]" value="' + file.file_name + '">')
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