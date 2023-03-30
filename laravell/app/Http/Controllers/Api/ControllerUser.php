<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\getResource;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ControllerUser extends Controller
{

    public function getAdmin()
    {
        $data = User::where('role', 'LIKE', '%Admin%')->get();

        if($data){
            return new getResource(true, 'Detail User', $data);
        }else{
            return response()->json("Not Found 404");
        }

    }

    public function show($id)
    {
        $data = User::where('user_id', $id)->get();

        if($data){
            return new getResource(true, 'Detail User', $data);
        }else{
            return response()->json("Not Found 404");
        }

    }

    public function getPegawai()
    {
        $data = User::where('role', 'Pegawai')->get();

        if($data){
            return new getResource(true, 'Detail User', $data);
        }else{
            return response()->json("Not Found 404");
        }

    }

    public function update(Request $req, $id)
    {

        $validator = Validator::make($req->all(), [
            'nama_user' => 'required',
            'nip' => 'required',
            'instansi' => 'required',
            'role' => 'required',
            'email' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        };

        $update = User::where('user_id', $id)->update([
            'nama_user' => $req->nama_user,
            'nip' => $req->nip,
            'instansi' => $req->instansi,
            'role' => $req->role,
            'email' => $req->email,]);

        if($update){
            return new getResource(true, 'Data User berhasil diubah', $update);
        }else{
            return response()->json("Data gagal diubah");
        }

    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'nama_user' => 'required',
            'nip' => 'required',
            'instansi' => 'required',
            'role' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        };

        $input = User::create([
            'nama_user' => $req->nama_user,
            'nip' => $req->nip,
            'instansi' => $req->instansi,
            'role' => $req->role,
            'email' => $req->email,
            'password' => Hash::make($req->password),
        ]);

        if($input){
            return new getResource(true, 'Data User berhasil ditambahkan', $input);
        }else{
            return response()->json("Gagal input");
        }

    }

    public function destroy($id)
    {
        $delete = User::where('user_id', $id)->delete();

        if($delete){
            return new getResource(true, 'Data User berhasil dihapus', $delete);
        }else{
            return response()->json("Gagal hapus data");
        }
    }

}
