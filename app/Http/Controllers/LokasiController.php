<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lokasi = Lokasi::all();

        return response()->json([
            "message" => "load data success",
            "data" => $lokasi
        ], 200);
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
        $message = [
            "kecamatan" => "Masukan Nama Kecamatan",
            "kabupaten" => "Masukan Nama Kabupaten",
            "provinsi" => "Masukan Nama Provinsi"
        ];
        $validasi = Validator::make($request->all(), [
            "kecamatan" => "required",
            "kabupaten" => "required",
            "provinsi" => "required"
        ], $message);
        if ($validasi->fails()) {
            return $validasi->errors();
        }
        $lokasi = Lokasi::create($validasi->validate());
        $lokasi->save();

        return response()->json([
            "message" => "load data success",
            "data" => $lokasi
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lokasi = Lokasi::find($id);
        if ($lokasi) {
            return $lokasi;
        } else {
            return ["message" => "Data tidak ada"];
        }
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
        $lokasi = Lokasi::findOrFail($id);
        $lokasi->update($request->all());
        $lokasi->save();

        return $lokasi;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dellokasi = Lokasi::find($id);
        if ($dellokasi) {
            $dellokasi->delete();
            return ["message" => "Delete Berhasil"];
        } else {
            return ["message" => "Delete tidak ada"];
        }
    }
}
