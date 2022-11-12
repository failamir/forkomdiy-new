<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyKontakRequest;
use App\Http\Requests\StoreKontakRequest;
use App\Http\Requests\UpdateKontakRequest;
use App\Models\Kontak;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KontakController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('kontak_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kontaks = Kontak::with(['team'])->get();

        return view('admin.kontaks.index', compact('kontaks'));
    }

    public function create()
    {
        abort_if(Gate::denies('kontak_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.kontaks.create');
    }

    public function store(StoreKontakRequest $request)
    {
        $kontak = Kontak::create($request->all());

        return redirect()->route('admin.kontaks.index');
    }

    public function edit(Kontak $kontak)
    {
        abort_if(Gate::denies('kontak_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kontak->load('team');

        return view('admin.kontaks.edit', compact('kontak'));
    }

    public function update(UpdateKontakRequest $request, Kontak $kontak)
    {
        $kontak->update($request->all());

        return redirect()->route('admin.kontaks.index');
    }

    public function show(Kontak $kontak)
    {
        abort_if(Gate::denies('kontak_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kontak->load('team', 'kontakKetuas');

        return view('admin.kontaks.show', compact('kontak'));
    }

    public function destroy(Kontak $kontak)
    {
        abort_if(Gate::denies('kontak_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kontak->delete();

        return back();
    }

    public function massDestroy(MassDestroyKontakRequest $request)
    {
        Kontak::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
