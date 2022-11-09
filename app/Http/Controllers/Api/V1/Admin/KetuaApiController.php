<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKetuaRequest;
use App\Http\Requests\UpdateKetuaRequest;
use App\Http\Resources\Admin\KetuaResource;
use App\Models\Ketua;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KetuaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ketua_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KetuaResource(Ketua::with(['team'])->get());
    }

    public function store(StoreKetuaRequest $request)
    {
        $ketua = Ketua::create($request->all());

        return (new KetuaResource($ketua))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Ketua $ketua)
    {
        abort_if(Gate::denies('ketua_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new KetuaResource($ketua->load(['team']));
    }

    public function update(UpdateKetuaRequest $request, Ketua $ketua)
    {
        $ketua->update($request->all());

        return (new KetuaResource($ketua))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Ketua $ketua)
    {
        abort_if(Gate::denies('ketua_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ketua->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
