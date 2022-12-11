<?php

namespace App\Http\Controllers;

use App\Http\Requests\MagazineSaveRequest;
use App\Http\Resources\MagazineResource;
use App\Models\MagazineModel;
use Illuminate\Http\Request;

class MagazineController extends Controller
{
    public function index()
    {
        $magazine = MagazineModel::get();
        return response()->json([
            'status' => true,
            'data' => MagazineResource::collection($magazine)
        ]);
    }

    public function store(MagazineSaveRequest $request)
    {

        $cover = $this->uploadCover($request->cover);
        $pdf = $this->uploadPdf($request->pdf_file);

        // $pdf = [];
        // if ($request->hasFile('pdf_file')) {
        //     $file = $request->file('pdf_file');

        //     $fileName = $file->getClientOriginalName();
        //     $path = $file->move('pdf', 'file_' . time() . '.' . $fileName);
        //     $path = str_replace('\\','/',$path);

        //     $attributes['image'] = $fileName;
        // }


        $file = new MagazineModel();
        $file->title = $request->title;
        $file->description = $request->description;
        $file->pdf_file = $pdf;
        $file->cover = $cover;

        $file->save();
        return response()->json([
            'status' => true,
            'messages' => 'Berhasil Menambahkan Magazine Baru'
        ]);
    }

    public function show(MagazineModel $magazine)
    {

        return response()->json([
            'status' => true,
            'data' => new MagazineResource($magazine)
        ]);
    }

    public function update(MagazineSaveRequest $request, $id)
    {
        $magazine = MagazineModel::find($id);

        if (!empty($request->cover)) {
            unlink($magazine->cover);
            $cover = $this->uploadCover($request->cover);
            $magazine->cover = $cover;
        }

        if (!empty($request->pdf_file)) {
            unlink($magazine->pdf_file);
            $pdf = $this->uploadPdf($request->pdf_file);
            $magazine->pdf_file = $pdf;
        }

        $magazine->title = $request->title;
        $magazine->description = $request->description;
        $magazine->save();

        return response()->json([
            'status' => true,
            'messages' => 'Magazine Berhasil Di Ubah'
        ]);
    }

    public function destroy($id)
    {
        $magazine = MagazineModel::find($id);

        $cover = public_path($magazine->cover);

        $pdf = public_path($magazine->pdf_file);

        if ($cover) {
            unlink($magazine->cover);
        }

        if ($pdf) {
            unlink($magazine->pdf_file);
        }

        MagazineModel::destroy($id);
        return response()->json([
            'status' => true,
            'messages' => 'Magazine Berhasil Di Hapus'
        ]);
    }

    public function uploadCover($cover)
    {
        $extFile = $cover->getClientOriginalName();
        $path = $cover->move('cover', $extFile);

        $path = str_replace('\\', '/', $path);

        return $path;
    }

    public function uploadPdf($pdf)
    {
        $extFile = $pdf->getClientOriginalName();
        $path2 = $pdf->move('pdf', $extFile);

        $path2 = str_replace('\\', '/', $path2);

        return $path2;
    }
}
