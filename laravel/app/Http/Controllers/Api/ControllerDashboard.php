<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\monitoring_realtimes;
use App\Http\Resources\getResource;

class ControllerDashboard extends Controller
{
        public function index()
    {
        
            $data1 = monitoring_realtimes::where('parameter', 'Beban Pembangkit')->get();
            $data2 = monitoring_realtimes::where('parameter', 'Frequency')->get();
            $data3 = monitoring_realtimes::where('parameter', 'Losses')->get();
            $data4 = monitoring_realtimes::where('parameter', 'Fuelmix')->get();
            $data5 = monitoring_realtimes::where('parameter', 'Fuelcost')->get();

            $realtime = [$data1, $data2, $data3, $data4, $data5];
            
            if($realtime){
                return new getResource(true, 'Data Realtime', $realtime);
            }else{
                return response()->json("Not Found 404");
            }

    }

    public function getpltu()
    {
        $data1 = monitoring_realtimes::where('parameter', 'LIKE', '%PLTU BOLOK%')->get();
        $data2 = monitoring_realtimes::where('parameter', 'LIKE', '%PLTU IPP%')->get();
    
        $data =[$data1, $data2];
            
        if($data){
            return new getResource(true, 'data PLTU', $data);
        }else{
            return response()->json("Not Found 404");
        }
    }

    public function getplant()
    {
            $data = monitoring_realtimes::where('parameter', 'LIKE', '%PLANT%')->get();
    
            if($data){
                return new getResource(true, 'data PLTU', $data);
            }else{
                return response()->json("Not Found 404");
            }

    }

    
    public function getDate()
    {
        $dateupdate = monitoring_realtimes::where('parameter', 'Beban Pembangkit')->get();

        if($dateupdate){
            return new getResource(true, 'Data Update', $dateupdate);
        }else{
            return response()->json("Not Found 404");
        }

    }
}
