<?php

namespace App\Http\Controllers;
use Validator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
class LoginAdminController extends Controller
{
    public function loginAdmin(Request $request){
        $theUrl  = config('app.guzzle_test_url').'/login';
        $response= Http::post($theUrl, [
            'email'=>$request->email,
            'password'=>$request->password,
        ]);
        $responseBody = json_decode($response->getBody());
        return redirect()->route('dashboard');
    }


    public function loginpost(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email tidak ditemukan',
            'password' => 'Password salah',
        ])->onlyInput('email', 'password');
    }

}
