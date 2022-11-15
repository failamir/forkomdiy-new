<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDataLembagaRequest;
use App\Http\Requests\StoreDataLembagaRequest;
use App\Http\Requests\UpdateDataLembagaRequest;
use App\Models\DataLembaga;
use App\Models\Ketua;
use App\Models\Kontak;
use App\Models\Perizinan;
use App\Models\Province;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DataLembagaController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('data_lembaga_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataLembagas = DataLembaga::with(['ketua', 'perizinan', 'provinsi', 'team', 'media'])->get();

        return view('admin.dataLembagas.index', compact('dataLembagas'));
    }

    public function create()
    {
        abort_if(Gate::denies('data_lembaga_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ketuas = Ketua::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $perizinans = Perizinan::pluck('nama_izin', 'id')->prepend(trans('global.pleaseSelect'), '');

        $provinsis = Province::pluck('province_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.dataLembagas.create', compact('ketuas', 'perizinans', 'provinsis'));
    }

    public function store(StoreDataLembagaRequest $request)
    {
        $dataLembaga = DataLembaga::all();
        if($dataLembaga->count() < 1){
            // $dataLembaga = DataLembaga::first();
            // $dataLembaga->update($request->all());
        $values = array('id' => 0,'contact_first_name' => $request->ketua_name);
        $contact= Kontak::create($values);
        
        $values = array('id' => 0,'kontak_id' => $contact->id,'periode' => $request->periode,'name' => $request->ketua_name);
        $anis = Ketua::create($values);
        
        
        // var_dump($request->ketua_id);die;
        $dataLembaga = DataLembaga::create($request->all());
        $dataLembaga->ketua_id = $anis->id;
        $dataLembaga->save();
        foreach ($request->input('lampiran', []) as $file) {
            $dataLembaga->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('lampiran');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $dataLembaga->id]);
        }

        return redirect()->route('admin.data-lembagas.index');
    }else{
        echo "<center><h1>Hanya bisa membuat satu data Lembaga</h1></center>";
        sleep(5);
        return redirect()->route('admin.data-lembagas.index');
    }
    }

    public function edit(DataLembaga $dataLembaga)
    {
        abort_if(Gate::denies('data_lembaga_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ketuas = Ketua::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $perizinans = Perizinan::pluck('nama_izin', 'id')->prepend(trans('global.pleaseSelect'), '');

        $provinsis = Province::pluck('province_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dataLembaga->load('ketua', 'perizinan', 'provinsi', 'team');

        return view('admin.dataLembagas.edit', compact('dataLembaga', 'ketuas', 'perizinans', 'provinsis'));
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

        return redirect()->route('admin.data-lembagas.index');
    }

    public function show(DataLembaga $dataLembaga)
    {
        abort_if(Gate::denies('data_lembaga_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataLembaga->load('ketua', 'perizinan', 'provinsi', 'team');

        return view('admin.dataLembagas.show', compact('dataLembaga'));
    }

    public function destroy(DataLembaga $dataLembaga)
    {
        abort_if(Gate::denies('data_lembaga_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dataLembaga->delete();

        return back();
    }

    public function massDestroy(MassDestroyDataLembagaRequest $request)
    {
        DataLembaga::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('data_lembaga_create') && Gate::denies('data_lembaga_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new DataLembaga();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
