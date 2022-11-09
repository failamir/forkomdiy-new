@extends('layouts.admin')
@section('content')
@can('instansi_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.instansis.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.instansi.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Instansi', 'route' => 'admin.instansis.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.instansi.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Instansi">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.instansi.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.instansi.fields.company_name') }}
                        </th>
                        <th>
                            {{ trans('cruds.instansi.fields.company_address') }}
                        </th>
                        <th>
                            {{ trans('cruds.instansi.fields.company_website') }}
                        </th>
                        <th>
                            {{ trans('cruds.instansi.fields.company_email') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($instansis as $key => $instansi)
                        <tr data-entry-id="{{ $instansi->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $instansi->id ?? '' }}
                            </td>
                            <td>
                                {{ $instansi->company_name ?? '' }}
                            </td>
                            <td>
                                {{ $instansi->company_address ?? '' }}
                            </td>
                            <td>
                                {{ $instansi->company_website ?? '' }}
                            </td>
                            <td>
                                {{ $instansi->company_email ?? '' }}
                            </td>
                            <td>
                                @can('instansi_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.instansis.show', $instansi->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('instansi_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.instansis.edit', $instansi->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('instansi_delete')
                                    <form action="{{ route('admin.instansis.destroy', $instansi->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('instansi_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.instansis.massDestroy') }}",
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
  let table = $('.datatable-Instansi:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection