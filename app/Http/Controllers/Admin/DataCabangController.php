<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDataCabangRequest;
use App\Http\Requests\StoreDataCabangRequest;
use App\Http\Requests\UpdateDataCabangRequest;
use App\Models\DataCabang;
use App\Models\District;
use Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DataCabangController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('data_cabang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if (Auth::user()->roles->pluck('id')[0] == 1) {
            $dataCabangs = DataCabang::with(['district', 'team', 'media'])
            // where('level_id', Auth::user()->roles->pluck('id')[0])
            // ->where('prov', Auth::user()->prov)
            // ->where('district_id', Auth::user()->district_id)
            ->get();
        } else if (Auth::user()->roles->pluck('id')[0] == 2) {
            $dataCabangs = DataCabang::with(['district', 'team', 'media'])
                // ->where('level_id', Auth::user()->roles->pluck('id')[0])
                // ->where('prov', Auth::user()->prov)
                // ->where('regency_id', Auth::user()->regency_id)
                // ->where('district_id', Auth::user()->district_id)
                ->get();
        } else if (Auth::user()->roles->pluck('id')[0] == 3) {
            $dataCabangs = DataCabang::with(['district', 'team', 'media'])
                // ->where('level_id', Auth::user()->roles->pluck('id')[0])
                // ->where('prov', Auth::user()->prov)
                // ->where('regency_id', Auth::user()->regency_id)
                ->where('regency_id', Auth::user()->regency_id)
                // ->where('village_id', Auth::user()->village_id)
                ->get();
        } else {
            $dataCabangs = DataCabang::with(['district', 'team', 'media'])
                ->where('level_id', Auth::user()->roles->pluck('id')[0])
                ->where('prov', Auth::user()->prov)
                ->where('regency_id', Auth::user()->regency_id)
                ->where('district_id', Auth::user()->district_id)
                ->where('village_id', Auth::user()->village_id)
                ->get();
        }
        return view('admin.dataCabangs.index', compact('dataCabangs'));
    }

    public function create()
    {
        abort_if(Gate::denies('data_cabang_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.dataCabangs.create', compact('districts'));
    }

    public function store(StoreDataCabangRequest $request)
    {
        $dataCabang = DataCabang::create($request->all());

        foreach ($request->input('lampiran', []) as $file) {
            $dataCabang->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('lampiran');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $dataCabang->id]);
        }

        return redirect()->route('admin.data-cabangs.index');
    }

    public function edit(DataCabang $dataCabang)
    {
        abort_if(Gate::denies('data_cabang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $districts = District::pluck('district_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dataCabang->load('district', 'team');

        return view('admin.dataCabangs.edit', compact('dataCabang', 'districts'));
    }

    public function update(UpdateDataCabangRequest $request, DataCabang $dataCabang)
    {
        $dataCabang->update($request->all());

        if (count($dataCabang->lampiran) > 0) {
            foreach ($dataCabang->lampiran as $media) {
                if (!in_array($media->file_name, $request->input('lampiran', []))) {
                    $media->delete();
                }
            }
        }
        $media = $dataCabang->lampiran->pluck('file_name')->toArray();
        foreach ($request->input('lampiran', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $dataCabang->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('lampiran');
            }
        }

        return redirect()->route('admin.data-cabangs.index');
    }

    public function show(DataCabang $dataCabang)
    {
        abort_if(Gate::denies('data_cabang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataCabang->load('district', 'team');

        return view('admin.dataCabangs.show', compact('dataCabang'));
    }

    public function destroy(DataCabang $dataCabang)
    {
        abort_if(Gate::denies('data_cabang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataCabang->delete();

        return back();
    }

    public function massDestroy(MassDestroyDataCabangRequest $request)
    {
        DataCabang::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('data_cabang_create') && Gate::denies('data_cabang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new DataCabang();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
