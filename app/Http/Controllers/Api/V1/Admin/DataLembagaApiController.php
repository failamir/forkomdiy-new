<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDataLembagaRequest;
use App\Http\Requests\UpdateDataLembagaRequest;
use App\Http\Resources\Admin\DataLembagaResource;
use App\Models\DataLembaga;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DataLembagaApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('data_lembaga_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataLembagaResource(DataLembaga::with(['ketua', 'perizinan', 'provinsi', 'team'])->get());
    }

    public function store(StoreDataLembagaRequest $request)
    {
        $dataLembaga = DataLembaga::create($request->all());

        foreach ($request->input('lampiran', []) as $file) {
            $dataLembaga->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('lampiran');
        }

        return (new DataLembagaResource($dataLembaga))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DataLembaga $dataLembaga)
    {
        abort_if(Gate::denies('data_lembaga_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataLembagaResource($dataLembaga->load(['ketua', 'perizinan', 'provinsi', 'team']));
    }

    public function update(UpdateDataLembagaRequest $request, DataLembaga $dataLembaga)
    {
        $dataLembaga->update($request->all());

        if (count($dataLembaga->lampiran) > 0) {
            foreach ($dataLembaga->lampiran as $media) {
                if (!in_array($media->file_name, $request->input('lampiran', []))) {
                    $media->delete();
                }
            }
        }
        $media = $dataLembaga->lampiran->pluck('file_name')->toArray();
        foreach ($request->input('lampiran', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $dataLembaga->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('lampiran');
            }
        }

        return (new DataLembagaResource($dataLembaga))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DataLembaga $dataLembaga)
    {
        abort_if(Gate::denies('data_lembaga_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataLembaga->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
