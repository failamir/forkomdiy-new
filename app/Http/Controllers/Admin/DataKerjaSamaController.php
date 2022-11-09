<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDataKerjaSamaRequest;
use App\Http\Requests\StoreDataKerjaSamaRequest;
use App\Http\Requests\UpdateDataKerjaSamaRequest;
use App\Models\DataKerjaSama;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DataKerjaSamaController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('data_kerja_sama_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataKerjaSamas = DataKerjaSama::with(['team', 'media'])->get();

        return view('admin.dataKerjaSamas.index', compact('dataKerjaSamas'));
    }

    public function create()
    {
        abort_if(Gate::denies('data_kerja_sama_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.dataKerjaSamas.create');
    }

    public function store(StoreDataKerjaSamaRequest $request)
    {
        $dataKerjaSama = DataKerjaSama::create($request->all());

        foreach ($request->input('lampiran', []) as $file) {
            $dataKerjaSama->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('lampiran');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $dataKerjaSama->id]);
        }

        return redirect()->route('admin.data-kerja-samas.index');
    }

    public function edit(DataKerjaSama $dataKerjaSama)
    {
        abort_if(Gate::denies('data_kerja_sama_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataKerjaSama->load('team');

        return view('admin.dataKerjaSamas.edit', compact('dataKerjaSama'));
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

        return redirect()->route('admin.data-kerja-samas.index');
    }

    public function show(DataKerjaSama $dataKerjaSama)
    {
        abort_if(Gate::denies('data_kerja_sama_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataKerjaSama->load('team');

        return view('admin.dataKerjaSamas.show', compact('dataKerjaSama'));
    }

    public function destroy(DataKerjaSama $dataKerjaSama)
    {
        abort_if(Gate::denies('data_kerja_sama_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataKerjaSama->delete();

        return back();
    }

    public function massDestroy(MassDestroyDataKerjaSamaRequest $request)
    {
        DataKerjaSama::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('data_kerja_sama_create') && Gate::denies('data_kerja_sama_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new DataKerjaSama();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
