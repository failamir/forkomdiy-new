<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstansiRequest;
use App\Http\Requests\UpdateInstansiRequest;
use App\Http\Resources\Admin\InstansiResource;
use App\Models\Instansi;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InstansiApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('instansi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstansiResource(Instansi::with(['team'])->get());
    }

    public function store(StoreInstansiRequest $request)
    {
        $instansi = Instansi::create($request->all());

        return (new InstansiResource($instansi))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Instansi $instansi)
    {
        abort_if(Gate::denies('instansi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new InstansiResource($instansi->load(['team']));
    }

    public function update(UpdateInstansiRequest $request, Instansi $instansi)
    {
        $instansi->update($request->all());

        return (new InstansiResource($instansi))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Instansi $instansi)
    {
        abort_if(Gate::denies('instansi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $instansi->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
