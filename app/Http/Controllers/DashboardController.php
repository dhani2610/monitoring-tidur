<?php

namespace App\Http\Controllers;

use App\Models\FitToWork;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function guard()
    {
        return Auth::guard('api');
    }

    public function dashboard()
    {
        $data = FitToWork::where('pembuat',$this->guard()->user()->id)->first();
        $perfect = 360 * 100;
        $min = $data->total_sleep * 100;
        $dataChart = floor($min/$perfect*100);

        if ($dataChart <= 100) {
            $persen =  $dataChart;
        }elseif ($dataChart >= 100){
            $persen =  100;
        }

        $t = $data->total_sleep;
        $h = floor($t/60) ? floor($t/60) .'h' : '00h';
        $m = $t%60 ? $t%60 .'m' : '00m';
        $totalSleep = $h . ' '. $m;

        return response()->json([
            'msg' => 'Berhasil',
            'data_chart' => $persen,
            'total_sleep' => $totalSleep,
            'bpm' => $data->average_bpm
        ]);
    }

    public function dashboardAdmin()
    {
        // CARD ATAS 
        $count_user = User::get()->count();
        $cukup_tidur = FitToWork::where('status','Cukup Tidur')->get()->count();
        $kurang_tidur = FitToWork::where('status','Kurang Tidur')->get()->count();

        $terpakai = $cukup_tidur + $kurang_tidur;
        $tidak_pakai = $count_user - $terpakai;
        
        // PERSENTASE 
        $perfect = $count_user * 100;
        $count_user_cukup_now = FitToWork::where('created_at',date('Y-m-d'))->where('status','Cukup Tidur')->get()->count();
        $count_user_kurang_cukup_now = FitToWork::where('created_at',date('Y-m-d'))->where('status','Kurang Tidur')->get()->count();

        $cukupnow = $count_user_cukup_now * 100;
        $kurangCukupnow = $count_user_kurang_cukup_now * 100;
        $tidakTerpakaiNow = $tidak_pakai * 100;

        $dataCukupNow = floor($cukupnow/$perfect*100);
        $dataKurangCukupNow = floor($kurangCukupnow/$perfect*100);
        $dataTidakPakai = floor($tidakTerpakaiNow/$perfect*100);

        return response()->json([
            'msg' => 'Berhasil',
            'cukup_tidur' => $cukup_tidur,
            'kurang_tidur' => $kurang_tidur,
            'tidak_pakai' => $tidak_pakai,
            'persentase_cukup' => $dataCukupNow,
            'persentase_kurang' => $dataKurangCukupNow,
            'persentase_tidak_pakai' => $dataTidakPakai,
        ]);
    }

    public function index()
    {
        $theUrl  = config('app.guzzle_test_url').'/dashboard-admin';
        $response= Http::get($theUrl, [
            'headers'=> ['Authorization' => session()->get('tokenJWT')]
        ]);
        // dd(session()->get('tokenJWT'));
        $responseBody = json_decode($response->getBody());
        return view('Backend.dashboard.index',compact('response'));
    }
}
