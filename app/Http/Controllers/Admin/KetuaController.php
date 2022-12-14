<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyKetuaRequest;
use App\Http\Requests\StoreKetuaRequest;
use App\Http\Requests\UpdateKetuaRequest;
use App\Models\Ketua;
use App\Models\Kontak;
use Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KetuaController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('ketua_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ketuas = Ketua::with(['kontak', 'team'])
        ->where('level_id',Auth::user()->roles->pluck('id')[0])
        ->where('prov', Auth::user()->prov)
        ->where('regency_id', Auth::user()->regency_id)
        ->where('district_id', Auth::user()->district_id)
        ->where('village_id', Auth::user()->village_id)
        ->get();

        return view('admin.ketuas.index', compact('ketuas'));
    }

    public function create()
    {
        abort_if(Gate::denies('ketua_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kontaks = Kontak::pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.ketuas.create', compact('kontaks'));
    }

    public function store(StoreKetuaRequest $request)
    {
        $ketua = Ketua::create($request->all());

        return redirect()->route('admin.ketuas.index');
    }

    public function edit(Ketua $ketua)
    {
        abort_if(Gate::denies('ketua_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kontaks = Kontak::pluck('contact_first_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ketua->load('kontak', 'team');

        return view('admin.ketuas.edit', compact('ketua', 'kontaks'));
    }

    public function update(UpdateKetuaRequest $request, Ketua $ketua)
    {
        $ketua->update($request->all());

        return redirect()->route('admin.ketuas.index');
    }

    public function show(Ketua $ketua)
    {
        abort_if(Gate::denies('ketua_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ketua->load('kontak', 'team', 'ketuaDataLembagas');

        return view('admin.ketuas.show', compact('ketua'));
    }

    public function destroy(Ketua $ketua)
    {
        abort_if(Gate::denies('ketua_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ketua->delete();

        return back();
    }

    public function massDestroy(MassDestroyKetuaRequest $request)
    {
        Ketua::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
