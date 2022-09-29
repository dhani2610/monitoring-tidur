<?php

namespace App\Http\Controllers;

use App\Models\FitToWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FitToWorkController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function guard()
    {
        return Auth::guard('api');
    }


    public function store(Request $request)
    {
 
        try {
            $data = new FitToWork();

            // CHECK WAKTU TIDUR 
            $total = floor($request->total_sleep / 60);
            if ( $total < 6) {
                $status = 'Kurang Tidur';
            }elseif ($total >= 6){
                $status =  'Cukup Tidur';
            }

            $data->create([
                'time_sleep_start' => $request->time_sleep_start,
                'time_sleep_end' => $request->time_sleep_end,
                'total_sleep' => $request->total_sleep,
                'heart_rate_min' => $request->heart_rate_min,
                'heart_rate_max' => $request->heart_rate_max,
                'average_bpm' => $request->average_bpm,
                'quest1' => $request->quest1,
                'quest2' => $request->quest2,
                'quest3' => $request->quest3,
                'status' => $status,
                'shift' =>  $request->shift,
                'pembuat' =>  $this->guard()->user()->id,
            ]);

            return response()->json([
                'msg' => 'Berhasil Simpan Data',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Gagal Simpan Data',
                'error' => $th->getMessage()
            ]);
        }
    }

    public function show(FitToWork $fitToWork)
    {
        //
    }

}
