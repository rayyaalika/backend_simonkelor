<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ControllerDashboard extends Controller
{
    public function test()
    {
        $data = 'test';
            
        if($data){
            return response()->json($data);
        }else{
            return response()->json("Not Found 404");
        }
    }
}
