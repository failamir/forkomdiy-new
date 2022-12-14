@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.dataCabang.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.data-cabangs.update", [$dataCabang->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="district_id">{{ trans('cruds.dataCabang.fields.district') }}</label>
                <select class="form-control select2 {{ $errors->has('district') ? 'is-invalid' : '' }}" name="district_id" id="district_id">
                    @foreach($districts as $id => $entry)
                        <option value="{{ $id }}" {{ (old('district_id') ? old('district_id') : $dataCabang->district->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('district'))
                    <div class="invalid-feedback">
                        {{ $errors->first('district') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataCabang.fields.district_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="nama_ketua">{{ trans('cruds.dataCabang.fields.nama_ketua') }}</label>
                <input class="form-control {{ $errors->has('nama_ketua') ? 'is-invalid' : '' }}" type="text" name="nama_ketua" id="nama_ketua" value="{{ old('nama_ketua', $dataCabang->nama_ketua) }}">
                @if($errors->has('nama_ketua'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_ketua') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataCabang.fields.nama_ketua_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="kontak_hp_wa">{{ trans('cruds.dataCabang.fields.kontak_hp_wa') }}</label>
                <input class="form-control {{ $errors->has('kontak_hp_wa') ? 'is-invalid' : '' }}" type="text" name="kontak_hp_wa" id="kontak_hp_wa" value="{{ old('kontak_hp_wa', $dataCabang->kontak_hp_wa) }}">
                @if($errors->has('kontak_hp_wa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kontak_hp_wa') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataCabang.fields.kontak_hp_wa_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="jumlah_anggota">{{ trans('cruds.dataCabang.fields.jumlah_anggota') }}</label>
                <input class="form-control {{ $errors->has('jumlah_anggota') ? 'is-invalid' : '' }}" type="number" name="jumlah_anggota" id="jumlah_anggota" value="{{ old('jumlah_anggota', $dataCabang->jumlah_anggota) }}" step="1">
                @if($errors->has('jumlah_anggota'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jumlah_anggota') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataCabang.fields.jumlah_anggota_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lampiran">{{ trans('cruds.dataCabang.fields.lampiran') }}</label>
                <div class="needsclick dropzone {{ $errors->has('lampiran') ? 'is-invalid' : '' }}" id="lampiran-dropzone">
                </div>
                @if($errors->has('lampiran'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lampiran') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dataCabang.fields.lampiran_helper') }}</span>
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
    url: '{{ route('admin.data-cabangs.storeMedia') }}',
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
@if(isset($dataCabang) && $dataCabang->lampiran)
          var files =
            {!! json_encode($dataCabang->lampiran) !!}
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