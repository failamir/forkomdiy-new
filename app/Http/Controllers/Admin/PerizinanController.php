<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPerizinanRequest;
use App\Http\Requests\StorePerizinanRequest;
use App\Http\Requests\UpdatePerizinanRequest;
use App\Models\Perizinan;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PerizinanController extends Controller
{
    use MediaUploadingTrait;
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('perizinan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $perizinans = Perizinan::with(['team', 'media'])
        ->where('level_id',Auth::user()->roles->pluck('id')[0])
        ->where('prov', Auth::user()->prov)
        ->where('regency_id', Auth::user()->regency_id)
        ->where('district_id', Auth::user()->district_id)
        ->where('village_id', Auth::user()->village_id)
        ->get();

        return view('admin.perizinans.index', compact('perizinans'));
    }

    public function create()
    {
        abort_if(Gate::denies('perizinan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.perizinans.create');
    }

    public function store(StorePerizinanRequest $request)
    {
        $perizinan = Perizinan::create($request->all());

        foreach ($request->input('lampiran_file', []) as $file) {
            $perizinan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('lampiran_file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $perizinan->id]);
        }

        return redirect()->route('admin.perizinans.index');
    }

    public function edit(Perizinan $perizinan)
    {
        abort_if(Gate::denies('perizinan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $perizinan->load('team');

        return view('admin.perizinans.edit', compact('perizinan'));
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

        return redirect()->route('admin.perizinans.index');
    }

    public function show(Perizinan $perizinan)
    {
        abort_if(Gate::denies('perizinan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $perizinan->load('team', 'perizinanDataLembagas');

        return view('admin.perizinans.show', compact('perizinan'));
    }

    public function destroy(Perizinan $perizinan)
    {
        abort_if(Gate::denies('perizinan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $perizinan->delete();

        return back();
    }

    public function massDestroy(MassDestroyPerizinanRequest $request)
    {
        Perizinan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('perizinan_create') && Gate::denies('perizinan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Perizinan();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
