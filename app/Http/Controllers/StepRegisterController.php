<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\returnSelf;

class StepRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function guard() 
    {
        return Auth::guard('api');
    }

    public function step1(Request $request)
    {
        try {
            $data = User::where('email',session()->get('email'))->where('gender',null)->where('tanggal_lahir',null)->first();
            $data->update([
                'gender' => $request->gender,
                'tanggal_lahir' => $request->tanggal_lahir
            ]);
    
            return response()->json([
                'msg' => 'Berhasil Step 1',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Gagal Step 1',
                'data' => $th->getMessage()
            ]);
        }
    }

    public function step2(Request $request)
    {
        
        try {
            $data = User::where('email',session()->get('email'))->where('goal',null)->first();
            $data->update([
                'goal' => $request->goal,
            ]);
    
            return response()->json([
                'msg' => 'Berhasil Step 2',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Gagal Step 2',
                'data' => $th->getMessage()
            ]);
        }
    }

    
    public function step3(Request $request)
    {
        
        try {
            $data = User::where('email',session()->get('email'))->where('tinggi_badan',null)->where('berat_badan',null)->first();
            $data->update([
                'tinggi_badan' => $request->tinggi_badan,
                'berat_badan' => $request->berat_badan,
            ]);
    
            return response()->json([
                'msg' => 'Berhasil Step 3',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Gagal Step 3',
                'data' => $th->getMessage()
            ]);
        }
    }
}
