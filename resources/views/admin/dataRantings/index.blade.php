@extends('layouts.admin')
@section('content')
@can('data_ranting_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @if(Auth::user()->roles->pluck('id')[0] == 5)
            {{-- @dump($dataRantings) --}}
            @if(count($dataRantings) == 0)
            <a class="btn btn-success" href="{{ route('admin.data-rantings.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.dataRanting.title_singular') }}
            </a>
            @endif
            @endif
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'DataRanting', 'route' => 'admin.data-rantings.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.dataRanting.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-DataRanting">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.dataRanting.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataRanting.fields.village') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataRanting.fields.nama_ketua') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataRanting.fields.kontak_hp_wa') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataRanting.fields.jumlah_anggota') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataRanting.fields.lampiran') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataRantings as $key => $dataRanting)
                        <tr data-entry-id="{{ $dataRanting->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $dataRanting->id ?? '' }}
                            </td>
                            <td>
                                {{ $dataRanting->village->village_name ?? '' }}
                            </td>
                            <td>
                                {{ $dataRanting->nama_ketua ?? '' }}
                            </td>
                            <td>
                                {{ $dataRanting->kontak_hp_wa ?? '' }}
                            </td>
                            <td>
                                {{ $dataRanting->jumlah_anggota ?? '' }}
                            </td>
                            <td>
                                @foreach($dataRanting->lampiran as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @can('data_ranting_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.data-rantings.show', $dataRanting->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('data_ranting_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.data-rantings.edit', $dataRanting->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('data_ranting_delete')
                                    <form action="{{ route('admin.data-rantings.destroy', $dataRanting->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('data_ranting_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.data-rantings.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  });
  let table = $('.datatable-DataRanting:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection