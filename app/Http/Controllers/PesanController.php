<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pesan = Pesan::all();

        return response()->json([
            "message" => "load data success",
            "data" => $pesan
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
            "tiket_id" => "Masukan Id Tiket",
            "user_id" => "Masukan Id User",
            "judul_konser" => "Masukan Judul Konser",
            "tempat_konser" => "Masukan Tempat Konser",
            "tanggal" => "Masukan Tanggal Konser",
            "jam" => "Masukan Jam Konser",
            "harga" => "Masukan Harga Tiket Konser",
            "kecamatan" => "Masukan Nama Kecamatan",
            "kabupaten" => "Masukan Nama Kabupaten",
            "provinsi" => "Masukan Nama Provinsi"
        ];
        $validasi = Validator::make($request->all(), [
            "tiket_id" => "required",
            "user_id" => "required",
            "judul_konser" => "required",
            "tempat_konser" => "required",
            "tanggal" => "required",
            "jam" => "required",
            "harga" => "required",
            "kecamatan" => "required",
            "kabupaten" => "required",
            "provinsi" => "required"
        ], $message);
        if ($validasi->fails()) {
            return $validasi->errors();
        }
        $pesan = Pesan::create($validasi->validate());
        $pesan->save();

        return response()->json([
            "message" => "load data success",
            "data" => $pesan
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
        $pesan = Pesan::find($id);
        if ($pesan) {
            return $pesan;
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
        $pesan = Pesan::findOrFail($id);
        $pesan->update($request->all());
        $pesan->save();

        return $pesan;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pesan = Pesan::find($id);
        if ($pesan) {
            $pesan->delete();
            return ["message" => "Delete Berhasil"];
        } else {
            return ["message" => "Delete Tidak Ada"];
        }
    }
}
