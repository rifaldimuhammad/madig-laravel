<?php

namespace App\Http\Controllers;

use App\Http\Resources\detailMagazineResource;
use App\Http\Resources\MagazineResource;
use App\Models\detailMagazineModel;
use Illuminate\Http\Request;

class detailMagazineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'table detail magazine data';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $img_file = $this->uploadImgFile($request->img_file);

        $file = new detailMagazineModel();
        $file->magazine_id = $request->magazine_id;
        $file->img_file = $img_file;
        $file->page = $request->page;

        $file->save();
        return response()->json([
            'status' => true,
            'messages' => 'Berhasil Menambahkan Magazine Baru'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dMagazine = detailMagazineModel::where('magazine_id', $id)->get();
        return response()->json([
            'status' => true,
            'data' => detailMagazineResource::collection($dMagazine)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function uploadImgFile($imgFile)
    {
        $extFile = $imgFile->getClientOriginalName();
        $path = $imgFile->move('pages', $extFile);

        $path = str_replace('\\', '/', $path);

        return $path;
    }
}
