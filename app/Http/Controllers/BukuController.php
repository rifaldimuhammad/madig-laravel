<?php

namespace App\Http\Controllers;

use App\Http\Requests\BukuSaveRequest;
use Illuminate\Http\Request;
use App\Http\Resources\BukuResource;
use App\Models\bukuModel;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = bukuModel::get();
        return response()->json([
            'status' => true,
            'data' => BukuResource::collection($buku)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BukuSaveRequest $request)
    {

        bukuModel::create($request->all());
        return response()->json([
            'status' => true,
            'messages' => 'Data buku berhasil disimpan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(bukuModel $buku)
    {

        return response()->json([
            'status' => true,
            'data' => new BukuResource($buku)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BukuSaveRequest $request, $id)
    {
        $buku = bukuModel::find($id);

        $buku->nama_buku = $request->nama_buku;
        $buku->nama_pengarang = $request->nama_pengarang;
        $buku->save();

        return response()->json([
            'status' => true,
            'messages' => 'Data buku berhasil diubah'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        bukuModel::destroy($id);
        return response()->json([
            'status' => true,
            'messages' => 'Data buku berhasil dihapus'
        ]);
    }
}
