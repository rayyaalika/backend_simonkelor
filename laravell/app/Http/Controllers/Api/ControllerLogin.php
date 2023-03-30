<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ControllerLogin extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        };

        $email = $request->only('email');
        $pass = $request->only('password');

        if($email && $pass){
            $cek_data = User::where('email', $email)->first();

            if($cek_data) { 
                
                $credentials = $request->only('email', 'password');
                
                $token = JWTAuth::attempt($credentials);
        
                if(!$token){
                    return response()->json([
                        'success' => false,
                        'message' => 'Email atau Password Anda salah'
                    ], 422);
                }
        
                return response()->json([
                    'success' => true,
                    'datauser'=> auth()->user(),
                    'token'   => $token,
                ], 200);

            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun Anda belum terdaftar'
                ]);
            }
        }

    }
}
