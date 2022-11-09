<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreDataDaerahRequest;
use App\Http\Requests\UpdateDataDaerahRequest;
use App\Http\Resources\Admin\DataDaerahResource;
use App\Models\DataDaerah;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DataDaerahApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('data_daerah_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataDaerahResource(DataDaerah::with(['regency', 'team'])->get());
    }

    public function store(StoreDataDaerahRequest $request)
    {
        $dataDaerah = DataDaerah::create($request->all());

        foreach ($request->input('lampiran', []) as $file) {
            $dataDaerah->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('lampiran');
        }

        return (new DataDaerahResource($dataDaerah))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(DataDaerah $dataDaerah)
    {
        abort_if(Gate::denies('data_daerah_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DataDaerahResource($dataDaerah->load(['regency', 'team']));
    }

    public function update(UpdateDataDaerahRequest $request, DataDaerah $dataDaerah)
    {
        $dataDaerah->update($request->all());

        if (count($dataDaerah->lampiran) > 0) {
            foreach ($dataDaerah->lampiran as $media) {
                if (!in_array($media->file_name, $request->input('lampiran', []))) {
                    $media->delete();
                }
            }
        }
        $media = $dataDaerah->lampiran->pluck('file_name')->toArray();
        foreach ($request->input('lampiran', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $dataDaerah->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('lampiran');
            }
        }

        return (new DataDaerahResource($dataDaerah))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(DataDaerah $dataDaerah)
    {
        abort_if(Gate::denies('data_daerah_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataDaerah->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
