<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyVillageRequest;
use App\Http\Requests\StoreVillageRequest;
use App\Http\Requests\UpdateVillageRequest;
use App\Models\Village;
use Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class VillagesController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('village_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Village::query()->select(sprintf('%s.*', (new Village())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'village_show';
                $editGate = 'village_edit';
                $deleteGate = 'village_delete';
                $crudRoutePart = 'villages';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('id_district', function ($row) {
                return $row->id_district ? $row->id_district : '';
            });
            $table->editColumn('id_village', function ($row) {
                return $row->id_village ? $row->id_village : '';
            });
            $table->editColumn('village_name', function ($row) {
                return $row->village_name ? $row->village_name : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.villages.index');
    }

    function add_ajax_des($id_kec){
        $query = DB::table('villages')->where('id_district',$id_kec)->get();
        $data = "<option value=''>Pilih Desa</option>";
        foreach ($query as $value) {
            $data .= "<option value='".$value->id."'>".$value->village_name."</option>";
        }
        echo $data;
    }

    public function create()
    {
        abort_if(Gate::denies('village_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.villages.create');
    }

    public function store(StoreVillageRequest $request)
    {
        $village = Village::create($request->all());

        return redirect()->route('admin.villages.index');
    }

    public function edit(Village $village)
    {
        abort_if(Gate::denies('village_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.villages.edit', compact('village'));
    }

    public function update(UpdateVillageRequest $request, Village $village)
    {
        $village->update($request->all());

        return redirect()->route('admin.villages.index');
    }

    public function show(Village $village)
    {
        abort_if(Gate::denies('village_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $village->load('villageDataRantings');

        return view('admin.villages.show', compact('village'));
    }

    public function destroy(Village $village)
    {
        abort_if(Gate::denies('village_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $village->delete();

        return back();
    }

    public function massDestroy(MassDestroyVillageRequest $request)
    {
        Village::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
