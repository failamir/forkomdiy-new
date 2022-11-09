@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.dataDaerah.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.data-daerahs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="regency_id">{{ trans('cruds.dataDaerah.fields.regency') }}</label>
                <select class="form-control select2 {{ $errors->has('regency') ? 'is-invalid' : '' }}" name="regency_id" id="regency_id">
                    @foreach($regencies as $id => $entry)
                        <option value="{{ $id }}" {{ old('regency_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('regency'))
                    <div class="invalid-feedback">
                        {{ $errors->first('regency') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataDaerah.fields.regency_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_ketua">{{ trans('cruds.dataDaerah.fields.nama_ketua') }}</label>
                <input class="form-control {{ $errors->has('nama_ketua') ? 'is-invalid' : '' }}" type="text" name="nama_ketua" id="nama_ketua" value="{{ old('nama_ketua', '') }}">
                @if($errors->has('nama_ketua'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_ketua') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataDaerah.fields.nama_ketua_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kontak_hp_wa">{{ trans('cruds.dataDaerah.fields.kontak_hp_wa') }}</label>
                <input class="form-control {{ $errors->has('kontak_hp_wa') ? 'is-invalid' : '' }}" type="text" name="kontak_hp_wa" id="kontak_hp_wa" value="{{ old('kontak_hp_wa', '') }}">
                @if($errors->has('kontak_hp_wa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kontak_hp_wa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataDaerah.fields.kontak_hp_wa_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="jumlah_anggota">{{ trans('cruds.dataDaerah.fields.jumlah_anggota') }}</label>
                <input class="form-control {{ $errors->has('jumlah_anggota') ? 'is-invalid' : '' }}" type="number" name="jumlah_anggota" id="jumlah_anggota" value="{{ old('jumlah_anggota', '') }}" step="1">
                @if($errors->has('jumlah_anggota'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jumlah_anggota') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataDaerah.fields.jumlah_anggota_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lampiran">{{ trans('cruds.dataDaerah.fields.lampiran') }}</label>
                <div class="needsclick dropzone {{ $errors->has('lampiran') ? 'is-invalid' : '' }}" id="lampiran-dropzone">
                </div>
                @if($errors->has('lampiran'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lampiran') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataDaerah.fields.lampiran_helper') }}</span>
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
    url: '{{ route('admin.data-daerahs.storeMedia') }}',
    maxFilesize: 20, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20
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
@if(isset($dataDaerah) && $dataDaerah->lampiran)
          var files =
            {!! json_encode($dataDaerah->lampiran) !!}
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