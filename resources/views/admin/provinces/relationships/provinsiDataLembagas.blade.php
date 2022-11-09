@can('data_lembaga_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.data-lembagas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.dataLembaga.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.dataLembaga.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-provinsiDataLembagas">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.dataLembaga.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataLembaga.fields.nama_lembaga') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataLembaga.fields.ketua') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataLembaga.fields.sekretariat_wilayah') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataLembaga.fields.website') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataLembaga.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataLembaga.fields.telp') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataLembaga.fields.whats_app') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataLembaga.fields.lingkup_kegiatan') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataLembaga.fields.perizinan') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataLembaga.fields.jumlah_anggota') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataLembaga.fields.lampiran') }}
                        </th>
                        <th>
                            {{ trans('cruds.dataLembaga.fields.provinsi') }}
                        </th>
                        <th>
                            {{ trans('cruds.province.fields.province_name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dataLembagas as $key => $dataLembaga)
                        <tr data-entry-id="{{ $dataLembaga->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $dataLembaga->id ?? '' }}
                            </td>
                            <td>
                                {{ $dataLembaga->nama_lembaga ?? '' }}
                            </td>
                            <td>
                                {{ $dataLembaga->ketua->name ?? '' }}
                            </td>
                            <td>
                                {{ $dataLembaga->sekretariat_wilayah ?? '' }}
                            </td>
                            <td>
                                {{ $dataLembaga->website ?? '' }}
                            </td>
                            <td>
                                {{ $dataLembaga->email ?? '' }}
                            </td>
                            <td>
                                {{ $dataLembaga->telp ?? '' }}
                            </td>
                            <td>
                                {{ $dataLembaga->whats_app ?? '' }}
                            </td>
                            <td>
                                {{ $dataLembaga->lingkup_kegiatan ?? '' }}
                            </td>
                            <td>
                                {{ $dataLembaga->perizinan->nama_izin ?? '' }}
                            </td>
                            <td>
                                {{ $dataLembaga->jumlah_anggota ?? '' }}
                            </td>
                            <td>
                                @foreach($dataLembaga->lampiran as $key => $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endforeach
                            </td>
                            <td>
                                {{ $dataLembaga->provinsi->province_name ?? '' }}
                            </td>
                            <td>
                                {{ $dataLembaga->provinsi->province_name ?? '' }}
                            </td>
                            <td>
                                @can('data_lembaga_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.data-lembagas.show', $dataLembaga->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('data_lembaga_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.data-lembagas.edit', $dataLembaga->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('data_lembaga_delete')
                                    <form action="{{ route('admin.data-lembagas.destroy', $dataLembaga->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('data_lembaga_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.data-lembagas.massDestroy') }}",
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
  let table = $('.datatable-provinsiDataLembagas:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection