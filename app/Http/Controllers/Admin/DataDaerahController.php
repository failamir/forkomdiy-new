<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDataDaerahRequest;
use App\Http\Requests\StoreDataDaerahRequest;
use App\Http\Requests\UpdateDataDaerahRequest;
use App\Models\DataDaerah;
use App\Models\Province;
use App\Models\Regency;
use Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DataDaerahController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('data_daerah_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (Auth::user()->roles->pluck('id')[0] == 1) {
        $dataDaerahs = DataDaerah::with(['regency', 'team', 'media'])->get();
        }else if (Auth::user()->roles->pluck('id')[0] <= 3) {
            $dataDaerahs = DataDaerah::with(['regency', 'team', 'media'])
            ->where('prov', Auth::user()->prov)    
            ->get();
        } else {
            $dataDaerahs = DataDaerah::with(['regency', 'team', 'media'])
                ->where('level_id', Auth::user()->roles->pluck('id')[0])
                ->where('prov', Auth::user()->prov)
                ->where('kab', Auth::user()->kab)
                ->where('kec', Auth::user()->kec)
                ->where('desa', Auth::user()->desa)
                ->get();
        }
        return view('admin.dataDaerahs.index', compact('dataDaerahs'));
    }

    public function create()
    {
        abort_if(Gate::denies('data_daerah_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regencies = Regency::pluck('regency_name', 'id')->prepend(trans('global.pleaseSelect'), '');
        // $provinsi = Province::all();
        // var_dump($regencies);die;
        return view('admin.dataDaerahs.create', compact('regencies'));
    }

    public function store(StoreDataDaerahRequest $request)
    {
        $dataDaerah = DataDaerah::create($request->all());

        foreach ($request->input('lampiran', []) as $file) {
            $dataDaerah->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('lampiran');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $dataDaerah->id]);
        }

        return redirect()->route('admin.data-daerahs.index');
    }

    public function edit(DataDaerah $dataDaerah)
    {
        abort_if(Gate::denies('data_daerah_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $regencies = Regency::pluck('regency_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dataDaerah->load('regency', 'team');

        return view('admin.dataDaerahs.edit', compact('dataDaerah', 'regencies'));
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

        return redirect()->route('admin.data-daerahs.index');
    }

    public function show(DataDaerah $dataDaerah)
    {
        abort_if(Gate::denies('data_daerah_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataDaerah->load('regency', 'team');

        return view('admin.dataDaerahs.show', compact('dataDaerah'));
    }

    public function destroy(DataDaerah $dataDaerah)
    {
        abort_if(Gate::denies('data_daerah_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataDaerah->delete();

        return back();
    }

    public function massDestroy(MassDestroyDataDaerahRequest $request)
    {
        DataDaerah::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('data_daerah_create') && Gate::denies('data_daerah_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new DataDaerah();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
