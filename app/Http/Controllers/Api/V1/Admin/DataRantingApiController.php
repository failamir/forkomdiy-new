<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDataRantingRequest;
use App\Http\Requests\UpdateDataRantingRequest;
use App\Http\Resources\Admin\DataRantingResource;
use App\Models\DataRanting;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DataRantingApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('data_ranting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataRantingResource(DataRanting::with(['village', 'team'])->get());
    }

    public function store(StoreDataRantingRequest $request)
    {
        $dataRanting = DataRanting::create($request->all());

        foreach ($request->input('lampiran', []) as $file) {
            $dataRanting->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('lampiran');
        }

        return (new DataRantingResource($dataRanting))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DataRanting $dataRanting)
    {
        abort_if(Gate::denies('data_ranting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataRantingResource($dataRanting->load(['village', 'team']));
    }

    public function update(UpdateDataRantingRequest $request, DataRanting $dataRanting)
    {
        $dataRanting->update($request->all());

        if (count($dataRanting->lampiran) > 0) {
            foreach ($dataRanting->lampiran as $media) {
                if (!in_array($media->file_name, $request->input('lampiran', []))) {
                    $media->delete();
                }
            }
        }
        $media = $dataRanting->lampiran->pluck('file_name')->toArray();
        foreach ($request->input('lampiran', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $dataRanting->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('lampiran');
            }
        }

        return (new DataRantingResource($dataRanting))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DataRanting $dataRanting)
    {
        abort_if(Gate::denies('data_ranting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataRanting->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
