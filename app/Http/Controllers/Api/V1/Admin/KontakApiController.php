<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKontakRequest;
use App\Http\Requests\UpdateKontakRequest;
use App\Http\Resources\Admin\KontakResource;
use App\Models\Kontak;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KontakApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('kontak_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KontakResource(Kontak::with(['team'])->get());
    }

    public function store(StoreKontakRequest $request)
    {
        $kontak = Kontak::create($request->all());

        return (new KontakResource($kontak))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Kontak $kontak)
    {
        abort_if(Gate::denies('kontak_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KontakResource($kontak->load(['team']));
    }

    public function update(UpdateKontakRequest $request, Kontak $kontak)
    {
        $kontak->update($request->all());

        return (new KontakResource($kontak))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Kontak $kontak)
    {
        abort_if(Gate::denies('kontak_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kontak->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
