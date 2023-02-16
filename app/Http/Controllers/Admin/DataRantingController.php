<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDataRantingRequest;
use App\Http\Requests\StoreDataRantingRequest;
use App\Http\Requests\UpdateDataRantingRequest;
use App\Models\DataRanting;
use App\Models\Village;
use Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DataRantingController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('data_ranting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (Auth::user()->roles->pluck('id')[0] == 1) {
            $dataRantings = DataRanting::with(['village', 'team', 'media'])->get();
        } elseif (Auth::user()->roles->pluck('id')[0]== 2) {
            $dataRantings = DataRanting::with(['village', 'team', 'media'])
            ->orwhere('prov', Auth::user()->prov)   
            // ->orwhere('kab', Auth::user()->kab)    
            // ->orwhere('kec', Auth::user()->kec)
                ->get();
        } elseif (Auth::user()->roles->pluck('id')[0] == 3) {
            $dataRantings = DataRanting::with(['village', 'team', 'media'])
                ->where('prov', Auth::user()->prov)
                ->where('kab', Auth::user()->kab)
                ->get();
        } else {
            $dataRantings = DataRanting::with(['village', 'team', 'media'])
                ->where('level_id', Auth::user()->roles->pluck('id')[0])
                ->where('prov', Auth::user()->prov)
                ->where('kab', Auth::user()->kab)
                ->where('kec', Auth::user()->kec)
                ->where('desa', Auth::user()->desa)
                ->get();
        }

        return view('admin.dataRantings.index', compact('dataRantings'));
    }

    public function create()
    {
        abort_if(Gate::denies('data_ranting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $villages = Village::pluck('village_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.dataRantings.create', compact('villages'));
    }

    public function store(StoreDataRantingRequest $request)
    {
        $dataRanting = DataRanting::create($request->all());

        foreach ($request->input('lampiran', []) as $file) {
            $dataRanting->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('lampiran');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $dataRanting->id]);
        }

        return redirect()->route('admin.data-rantings.index');
    }

    public function edit(DataRanting $dataRanting)
    {
        abort_if(Gate::denies('data_ranting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $villages = Village::pluck('village_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dataRanting->load('village', 'team');

        return view('admin.dataRantings.edit', compact('dataRanting', 'villages'));
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

        return redirect()->route('admin.data-rantings.index');
    }

    public function show(DataRanting $dataRanting)
    {
        abort_if(Gate::denies('data_ranting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataRanting->load('village', 'team');

        return view('admin.dataRantings.show', compact('dataRanting'));
    }

    public function destroy(DataRanting $dataRanting)
    {
        abort_if(Gate::denies('data_ranting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataRanting->delete();

        return back();
    }

    public function massDestroy(MassDestroyDataRantingRequest $request)
    {
        DataRanting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('data_ranting_create') && Gate::denies('data_ranting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new DataRanting();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
