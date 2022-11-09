<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyRegencyRequest;
use App\Http\Requests\StoreRegencyRequest;
use App\Http\Requests\UpdateRegencyRequest;
use App\Models\Regency;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegenciesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('regency_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regencies = Regency::all();

        return view('admin.regencies.index', compact('regencies'));
    }

    public function create()
    {
        abort_if(Gate::denies('regency_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.regencies.create');
    }

    public function store(StoreRegencyRequest $request)
    {
        $regency = Regency::create($request->all());

        return redirect()->route('admin.regencies.index');
    }

    public function edit(Regency $regency)
    {
        abort_if(Gate::denies('regency_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.regencies.edit', compact('regency'));
    }

    public function update(UpdateRegencyRequest $request, Regency $regency)
    {
        $regency->update($request->all());

        return redirect()->route('admin.regencies.index');
    }

    public function show(Regency $regency)
    {
        abort_if(Gate::denies('regency_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regency->load('regencyDataDaerahs');

        return view('admin.regencies.show', compact('regency'));
    }

    public function destroy(Regency $regency)
    {
        abort_if(Gate::denies('regency_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regency->delete();

        return back();
    }

    public function massDestroy(MassDestroyRegencyRequest $request)
    {
        Regency::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
