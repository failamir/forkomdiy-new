@extends('layouts.admin')
@section('content')
@can('data_daerah_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @if(empty($dataCabangs))
            {{-- @if(count($dataCabangs) == 0) --}}
            <a class="btn btn-success" href="{{ route('admin.data-daerahs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.dataDaerah.title_singular') }}
            </a>
            {{-- @endif --}}
            @endif
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'DataDaerah', 'route' => 'admin.data-daerahs.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.dataDaerah.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-DataDaerah">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.dataDaerah.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataDaerah.fields.regency') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataDaerah.fields.nama_ketua') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataDaerah.fields.kontak_hp_wa') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataDaerah.fields.jumlah_anggota') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataDaerah.fields.lampiran') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataDaerahs as $key => $dataDaerah)
                        <tr data-entry-id="{{ $dataDaerah->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $dataDaerah->id ?? '' }}
                            </td>
                            <td>
                                {{ $dataDaerah->regency->regency_name ?? '' }}
                            </td>
                            <td>
                                {{ $dataDaerah->nama_ketua ?? '' }}
                            </td>
                            <td>
                                {{ $dataDaerah->kontak_hp_wa ?? '' }}
                            </td>
                            <td>
                                {{ $dataDaerah->jumlah_anggota ?? '' }}
                            </td>
                            <td>
                                @foreach($dataDaerah->lampiran as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                @can('data_daerah_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.data-daerahs.show', $dataDaerah->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('data_daerah_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.data-daerahs.edit', $dataDaerah->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('data_daerah_delete')
                                    <form action="{{ route('admin.data-daerahs.destroy', $dataDaerah->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('data_daerah_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.data-daerahs.massDestroy') }}",
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
  let table = $('.datatable-DataDaerah:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection