@extends('layouts.admin')
@section('content')
    @can('data_cabang_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                {{-- @if (count($dataCabangs) == 0) --}}
                @if(empty($dataCabangs)  && Auth::user()->regency_id == 4 )
                    <a class="btn btn-success" href="{{ route('admin.data-cabangs.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.dataCabang.title_singular') }}
                    </a>
                @elseif(Auth::user()->id == 1)
                <a class="btn btn-success" href="{{ route('admin.data-cabangs.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.dataCabang.title_singular') }}
                </a>
                @endif
                {{-- {{ Auth::user()->regency_id }} --}}
                @if( Auth::id() == 3 )
                <a class="btn btn-success" href="{{ route('admin.data-cabangs.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.dataCabang.title_singular') }}
                </a>
                @endif

                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', [
                    'model' => 'DataCabang',
                    'route' => 'admin.data-cabangs.parseCsvImport',
                ])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.dataCabang.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-DataCabang">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.dataCabang.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataCabang.fields.district') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataCabang.fields.nama_ketua') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataCabang.fields.kontak_hp_wa') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataCabang.fields.jumlah_anggota') }}
                            </th>
                            <th>
                                {{ trans('cruds.dataCabang.fields.lampiran') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataCabangs as $key => $dataCabang)
                            <tr data-entry-id="{{ $dataCabang->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $dataCabang->id ?? '' }}
                                </td>
                                <td>
                                    {{ $dataCabang->district->district_name ?? '' }}
                                </td>
                                <td>
                                    {{ $dataCabang->nama_ketua ?? '' }}
                                </td>
                                <td>
                                    {{ $dataCabang->kontak_hp_wa ?? '' }}
                                </td>
                                <td>
                                    {{ $dataCabang->jumlah_anggota ?? '' }}
                                </td>
                                <td>
                                    @foreach ($dataCabang->lampiran as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @can('data_cabang_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('admin.data-cabangs.show', $dataCabang->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @if ($dataCabang->user_id == Auth::user()->id)
                                        @can('data_cabang_edit')
                                            <a class="btn btn-xs btn-info"
                                                href="{{ route('admin.data-cabangs.edit', $dataCabang->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>
                                        @endcan

                                        @can('data_cabang_delete')
                                            <form action="{{ route('admin.data-cabangs.destroy', $dataCabang->id) }}"
                                                method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-danger"
                                                    value="{{ trans('global.delete') }}">
                                            </form>
                                        @endcan
                                    @endif

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
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('data_cabang_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.data-cabangs.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 10,
            });
            let table = $('.datatable-DataCabang:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
