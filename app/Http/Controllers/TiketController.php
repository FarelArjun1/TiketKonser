<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiket = Tiket::all();

        return response()->json([
            "message" => "load data success",
            "data" => $tiket
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
            "judul_konser" => "Masukan Judul Konser",
            "tempat_konser" => "Masukan Tempat Konser",
            "tanggal" => "Masukan Tanggal Konser",
            "jam" => "Masukan Jam Konser",
            "harga" => "Masukan Harga Tiket Konser"
        ];
        $validasi = Validator::make($request->all(), [
            "judul_konser" => "required",
            "tempat_konser" => "required",
            "tanggal" => "required",
            "jam" => "required",
            "harga" => "required"
        ], $message);
        if ($validasi->fails()) {
            return $validasi->errors();
        }
        $tiket = Tiket::create($validasi->validate());
        $tiket->save();

        return response()->json([
            "message" => "load data success",
            "data" => $tiket
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
        $tiket = Tiket::find($id);
        if ($tiket) {
            return $tiket;
        } else {
            return ["message" => "Data Tidak Ada"];
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
        $tiket = Tiket::findOrFail($id);
        $tiket->update($request->all());
        $tiket->save();

        return $tiket;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tiket = Tiket::find($id);
        if ($tiket) {
            $tiket->delete();
            return ["message" => "Delete Berhasil"];
        } else {
            return ["message" => "Delete tidak ada"];
        }
    }
}
