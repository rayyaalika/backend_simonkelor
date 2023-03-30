<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\getResource;
use App\Models\Pembangkit;
use Illuminate\Support\Facades\Validator;

class ControllerPembangkit extends Controller
{

    public function show($id)
    {
        $data = Pembangkit::where('id_pembangkit',$id)->get();

        if($data){
            return new getResource(true, 'Detail Data Pembangkit', $data);
        }else{
            return response()->json("Not Found 404");
        }

    }

    public function index()
    {
        $data = Pembangkit::all();

        if($data){
            return new getResource(true, 'Data Pembangkit', $data);
        }else{
            return response()->json("Not Found 404");
        }

    }

    public function update(Request $req, $id)
    {

        $validator = Validator::make($req->all(), [
            'nama_pembangkit' => 'required',
            'jenis_pembangkit' => 'required',
            'kepemilikan_aset' => 'required',
            'energi_primer' => 'required',
            'kapasitas' => 'required',
            'DMN' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        };

        $update = Pembangkit::where('id_pembangkit', $id)->update([
            'nama_pembangkit' => $req->nama_pembangkit,
            'jenis_pembangkit' => $req->jenis_pembangkit,
            'kepemilikan_aset' => $req->kepemilikan_aset,
            'energi_primer' => $req->energi_primer,
            'kapasitas' => $req->kapasitas,
            'DMN' => $req->DMN,
        ]);

        if($update){
            return new getResource(true, 'Data User berhasil diubah', $update);
        }else{
            return response()->json("Data gagal diubah");
        }

    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'nama_pembangkit' => 'required',
            'jenis_pembangkit' => 'required',
            'kepemilikan_aset' => 'required',
            'energi_primer' => 'required',
            'kapasitas' => 'required',
            'DMN' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        };

        $input = Pembangkit::create([
            'nama_pembangkit' => $req->nama_pembangkit,
            'jenis_pembangkit' => $req->jenis_pembangkit,
            'kepemilikan_aset' => $req->kepemilikan_aset,
            'energi_primer' => $req->energi_primer,
            'kapasitas' => $req->kapasitas,
            'DMN' => $req->DMN,
        ]);

        if($input){
            return new getResource(true, 'Data User berhasil ditambahkan', $input);
        }else{
            return response()->json("Gagal input");
        }

    }

    public function destroy($id)
    {
        $delete = Pembangkit::where('id_pembangkit', $id)->delete();

        if($delete){
            return new getResource(true, 'Data User berhasil dihapus', $delete);
        }else{
            return response()->json("Gagal hapus data");
        }
    }
}
