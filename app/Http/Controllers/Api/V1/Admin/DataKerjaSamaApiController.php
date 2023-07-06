<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDataKerjaSamaRequest;
use App\Http\Requests\UpdateDataKerjaSamaRequest;
use App\Http\Resources\Admin\DataKerjaSamaResource;
use App\Models\DataKerjaSama;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DataKerjaSamaApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('data_kerja_sama_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataKerjaSamaResource(DataKerjaSama::with(['team'])->get());
    }

    public function store(StoreDataKerjaSamaRequest $request)
    {
        $dataKerjaSama = DataKerjaSama::create($request->all());

        foreach ($request->input('lampiran', []) as $file) {
            $dataKerjaSama->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('lampiran');
        }

        return (new DataKerjaSamaResource($dataKerjaSama))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DataKerjaSama $dataKerjaSama)
    {
        abort_if(Gate::denies('data_kerja_sama_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataKerjaSamaResource($dataKerjaSama->load(['team']));
    }

    public function update(UpdateDataKerjaSamaRequest $request, DataKerjaSama $dataKerjaSama)
    {
        $dataKerjaSama->update($request->all());

        if (count($dataKerjaSama->lampiran) > 0) {
            foreach ($dataKerjaSama->lampiran as $media) {
                if (!in_array($media->file_name, $request->input('lampiran', []))) {
                    $media->delete();
                }
            }
        }
        $media = $dataKerjaSama->lampiran->pluck('file_name')->toArray();
        foreach ($request->input('lampiran', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $dataKerjaSama->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('lampiran');
            }
        }

        return (new DataKerjaSamaResource($dataKerjaSama))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DataKerjaSama $dataKerjaSama)
    {
        abort_if(Gate::denies('data_kerja_sama_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataKerjaSama->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
