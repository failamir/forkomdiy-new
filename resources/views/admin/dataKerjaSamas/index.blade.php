@extends('layouts.admin')
@section('content')
@can('data_kerja_sama_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.data-kerja-samas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.dataKerjaSama.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'DataKerjaSama', 'route' => 'admin.data-kerja-samas.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.dataKerjaSama.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-DataKerjaSama">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.nama_stakeholder') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.jangkauan_kerjasama') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.lampiran') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.jenis_kerjasama') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.mulai_kerjasama') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.frekuensi_kerjasama') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.no_hp_wa_lembaga') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.kontak_di_lembaga') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.no_hp_wa_stakeholder') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataKerjaSama.fields.nama_lembaga_kerjasama') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataKerjaSamas as $key => $dataKerjaSama)
                        <tr data-entry-id="{{ $dataKerjaSama->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $dataKerjaSama->id ?? '' }}
                            </td>
                            <td>
                                {{ $dataKerjaSama->nama_stakeholder ?? '' }}
                            </td>
                            <td>
                                {{ $dataKerjaSama->jangkauan_kerjasama ?? '' }}
                            </td>
                            <td>
                                @foreach($dataKerjaSama->lampiran as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $dataKerjaSama->jenis_kerjasama ?? '' }}
                            </td>
                            <td>
                                {{ $dataKerjaSama->mulai_kerjasama ?? '' }}
                            </td>
                            <td>
                                {{ $dataKerjaSama->frekuensi_kerjasama ?? '' }}
                            </td>
                            <td>
                                {{ $dataKerjaSama->no_hp_wa_lembaga ?? '' }}
                            </td>
                            <td>
                                {{ $dataKerjaSama->kontak_di_lembaga ?? '' }}
                            </td>
                            <td>
                                {{ $dataKerjaSama->no_hp_wa_stakeholder ?? '' }}
                            </td>
                            <td>
                                {{ $dataKerjaSama->nama_lembaga_kerjasama ?? '' }}
                            </td>
                            <td>
                                @can('data_kerja_sama_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.data-kerja-samas.show', $dataKerjaSama->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('data_kerja_sama_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.data-kerja-samas.edit', $dataKerjaSama->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('data_kerja_sama_delete')
                                    <form action="{{ route('admin.data-kerja-samas.destroy', $dataKerjaSama->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('data_kerja_sama_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.data-kerja-samas.massDestroy') }}",
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
  let table = $('.datatable-DataKerjaSama:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection