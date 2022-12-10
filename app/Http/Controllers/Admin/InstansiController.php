<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyInstansiRequest;
use App\Http\Requests\StoreInstansiRequest;
use App\Http\Requests\UpdateInstansiRequest;
use App\Models\Instansi;
use Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstansiController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('instansi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instansis = Instansi::with(['team'])
        ->where('level_id',Auth::user()->roles->pluck('id')[0])
        ->where('prov', Auth::user()->prov)
        ->where('regency_id', Auth::user()->regency_id)
        ->where('district_id', Auth::user()->district_id)
        ->where('village_id', Auth::user()->village_id)
        ->get();

        return view('admin.instansis.index', compact('instansis'));
    }

    public function create()
    {
        abort_if(Gate::denies('instansi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.instansis.create');
    }

    public function store(StoreInstansiRequest $request)
    {
        $instansi = Instansi::create($request->all());

        return redirect()->route('admin.instansis.index');
    }

    public function edit(Instansi $instansi)
    {
        abort_if(Gate::denies('instansi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instansi->load('team');

        return view('admin.instansis.edit', compact('instansi'));
    }

    public function update(UpdateInstansiRequest $request, Instansi $instansi)
    {
        $instansi->update($request->all());

        return redirect()->route('admin.instansis.index');
    }

    public function show(Instansi $instansi)
    {
        abort_if(Gate::denies('instansi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instansi->load('team');

        return view('admin.instansis.show', compact('instansi'));
    }

    public function destroy(Instansi $instansi)
    {
        abort_if(Gate::denies('instansi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instansi->delete();

        return back();
    }

    public function massDestroy(MassDestroyInstansiRequest $request)
    {
        Instansi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
