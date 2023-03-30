<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\getResource;
use App\Models\user_registrasis;

class ControllerRegitrasi extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'nama_user' => 'required',
            'nip' => 'required',
            'instansi' => 'required',
            'role' => 'required',
            'email' => 'required',
            'password' => 'required|string|min:8',
        ]);

        $confirm_pass = Validator::make($req->all(), [
            'password' => 'confirmed',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        };

        if($confirm_pass->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Password konfirmasi tidak sesuai'
            ], 422);
        };

        $input = user_registrasis::create([
            'nama_user' => $req->nama_user,
            'nip' => $req->nip,
            'instansi' => $req->instansi,
            'role' => $req->role,
            'email' => $req->email,
            'password' => $req->password,
        ]);

        if($input){
            return new getResource(true, 'Registrasi Berhasil', $input);
        }else{
            return response()->json("Registrasi Gagal");
        }
    }
    
    public function index()
    {
        $data = user_registrasis::all();

        if($data){
            return new getResource(true, 'Data user', $data);
        }else{
            return response()->json("Not Found 404");
        }

    }

    public function destroy($id)
    {
        $delete = user_registrasis::where('id', $id)->delete();

        if($delete){
            return new getResource(true, 'Data User berhasil dihapus', $delete);
        }else{
            return response()->json("Gagal hapus data");
        }
    }
}
