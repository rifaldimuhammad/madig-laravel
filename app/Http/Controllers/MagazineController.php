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

    // public function edit($id)
    // {
    //     // Fungsi untuk mengambil data galeri sesuai dengan id
    //     $magazine = MagazineModel::find($id);

    //     return response()->json([
    //         'status' => true,
    //         'data' => MagazineResource::collection($magazine)
    //     ]);
    // }

    public function update(MagazineSaveRequest $request, $id)
    {
        $magazine = MagazineModel::find($id);

        if (!empty($request->cover)) {
            unlink($magazine->cover);
            $cover = $this->uploadCover($request->cover);
            $magazine->cover = $cover;
        }

        $magazine->title = $request->title;
        $magazine->description = $request->description;
        $magazine->pdf_file = $request->pdf_file;
        $magazine->save();

        return response()->json([
            'status' => true,
            'messages' => 'Magazine Berhasil Di Ubah'
        ]);
    }

    public function destroy($id)
    {
        MagazineModel::destroy($id);
        return response()->json([
            'status' => true,
            'messages' => 'Magazine Berhasil Di Hapus'
        ]);
    }

    public function uploadCover($cover)
    {
        $extFile = $cover->getClientOriginalName();
        $path = $cover->move('cover', 'file_' . time() . '.' . $extFile);
        $path = str_replace('\\', '/', $path);

        return $path;
    }

    public function uploadPdf($pdf)
    {
        $extFile = $pdf->getClientOriginalName();
        $path = $pdf->move('pdf', 'file_' . time() . '.' . $extFile);
        $path = str_replace('\\', '/', $path);

        return $path;
    }
}
