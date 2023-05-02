<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Forum;
use App\Http\Resources\getResource;
use Illuminate\Support\Facades\Validator;

class ControllerForum extends Controller
{
    public function index()
    {
        $data = Forum::all();

        if($data){
            return new getResource(true, 'Data Forum', $data);
        }else{
            return response()->json("Not Found 404");
        }

    }
    
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'nama_user' => 'required',
            'pesan' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        };

        $input = Forum::create([
            'nama_user' => $req->nama_user,
            'pesan' => $req->pesan,
            'gambar' => 'sampul.png'
        ]);

        if($input){
            return new getResource(true, 'Pesan berhasil ditambahkan', $input);
        }else{
            return response()->json("Gagal input");
        }

    }
}
