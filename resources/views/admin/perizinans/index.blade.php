@extends('layouts.admin')
@section('content')
@can('perizinan_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.perizinans.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.perizinan.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Perizinan', 'route' => 'admin.perizinans.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.perizinan.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Perizinan">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.perizinan.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.perizinan.fields.instansi_penerbit') }}
                        </th>
                        <th>
                            {{ trans('cruds.perizinan.fields.nomor_izin') }}
                        </th>
                        <th>
                            {{ trans('cruds.perizinan.fields.lampiran_file') }}
                        </th>
                        <th>
                            {{ trans('cruds.perizinan.fields.nama_izin') }}
                        </th>
                        <th>
                            {{ trans('cruds.perizinan.fields.tanggal_dikeluarkan') }}
                        </th>
                        <th>
                            {{ trans('cruds.perizinan.fields.berlaku_sampai') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($perizinans as $key => $perizinan)
                        <tr data-entry-id="{{ $perizinan->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $perizinan->id ?? '' }}
                            </td>
                            <td>
                                {{ $perizinan->instansi_penerbit ?? '' }}
                            </td>
                            <td>
                                {{ $perizinan->nomor_izin ?? '' }}
                            </td>
                            <td>
                                @foreach($perizinan->lampiran_file as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $perizinan->nama_izin ?? '' }}
                            </td>
                            <td>
                                {{ $perizinan->tanggal_dikeluarkan ?? '' }}
                            </td>
                            <td>
                                {{ $perizinan->berlaku_sampai ?? '' }}
                            </td>
                            <td>
                                @can('perizinan_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.perizinans.show', $perizinan->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('perizinan_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.perizinans.edit', $perizinan->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('perizinan_delete')
                                    <form action="{{ route('admin.perizinans.destroy', $perizinan->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('perizinan_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.perizinans.massDestroy') }}",
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
  let table = $('.datatable-Perizinan:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection