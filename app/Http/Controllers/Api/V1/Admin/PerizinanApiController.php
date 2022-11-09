<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePerizinanRequest;
use App\Http\Requests\UpdatePerizinanRequest;
use App\Http\Resources\Admin\PerizinanResource;
use App\Models\Perizinan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PerizinanApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('perizinan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PerizinanResource(Perizinan::with(['team'])->get());
    }

    public function store(StorePerizinanRequest $request)
    {
        $perizinan = Perizinan::create($request->all());

        foreach ($request->input('lampiran_file', []) as $file) {
            $perizinan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('lampiran_file');
        }

        return (new PerizinanResource($perizinan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Perizinan $perizinan)
    {
        abort_if(Gate::denies('perizinan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PerizinanResource($perizinan->load(['team']));
    }

    public function update(UpdatePerizinanRequest $request, Perizinan $perizinan)
    {
        $perizinan->update($request->all());

        if (count($perizinan->lampiran_file) > 0) {
            foreach ($perizinan->lampiran_file as $media) {
                if (!in_array($media->file_name, $request->input('lampiran_file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $perizinan->lampiran_file->pluck('file_name')->toArray();
        foreach ($request->input('lampiran_file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $perizinan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('lampiran_file');
            }
        }

        return (new PerizinanResource($perizinan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Perizinan $perizinan)
    {
        abort_if(Gate::denies('perizinan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $perizinan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
