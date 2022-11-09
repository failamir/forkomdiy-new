<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyVillageRequest;
use App\Http\Requests\StoreVillageRequest;
use App\Http\Requests\UpdateVillageRequest;
use App\Models\Village;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VillagesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('village_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $villages = Village::all();

        return view('admin.villages.index', compact('villages'));
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
