<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use App\Models\Notifikasi;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use File;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function user()
    {
        $data = User::get();
        return response()->json([
            'msg' => 'Berhasil',
            'data' => $data
        ]);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'tlp' => 'required',
            'status_otp' => 'nullable',
            'role' => 'nullable',
            'gender' => 'nullable',
            'tanggal_lahir' => 'nullable',
            'goal' => 'nullable',
            'tinggi_badan' => 'nullable',
            'berat_badan' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
   
        if ($request->role == 'Admin') {
            $role = 'Admin';
        }elseif ($request->role == 'User'){
            $role = 'User';
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'tlp' => $request->tlp,
            'status_otp' => 'Not Verif',
            'role' => $role,
            'gender' => $request->gender,
            'tanggal_lahir' => $request->tanggal_lahir,
            'goal' => $request->goal,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
        ]);

        return response()->json([
            'message' => 'Successfully registered',
            'user' => $user,
        ], 201);
    }

    
    /**
     * Get a JWT token via given credentials.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if ($request->email) {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
            ]);
        }elseif ($request->tlp){
            $validator = Validator::make($request->all(), [
                'tlp' => 'required',
                'password' => 'required|string|min:6',
            ]);
        }

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = $this->guard()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }


    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json([
            'data' => $this->guard()->user()
        ]);
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        session()->put('tokenJWT', $token);
        $tokenjwt = session()->get('tokenJWT');
        
        return response()->json([
            'msg' => 'Successfully',
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users'.$this->guard()->user()->id,
            'nama_perusahaan' => 'required',
            'alamat_perusahaan' => 'required',
            'foto' =>  'nullable|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        try {
            $data = User::find($this->guard()->user()->id);
            $data->name = $request->name;
            $data->email = $request->email;
            $data->nama_perusahaan = $request->nama_perusahaan;
            $data->alamat_perusahaan = $request->alamat_perusahaan;

            if ($request->hasFile('foto')) {
                // Delete Img
                if ($data->foto) {
                    $image_path = public_path('img-user/'.$data->foto); // Value is not URL but directory file path
                    if (File::exists($image_path)) {
                        File::delete($image_path);
                    }
                }
                
                $image = $request->file('foto');
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('img-user/');
                $image->move($destinationPath, $name);
                $data->foto = $name;
            }
            $data->update();
  
            $newNotifikasi = new Notifikasi();
            $newNotifikasi->judul = 'Berhasil Edit';
            $newNotifikasi->deskripsi = 'Anda Berhasil Mengedit Akun ';
            $newNotifikasi->datetime = date('Y-m-d H:i:s');
            $newNotifikasi->pembuat =  $this->guard()->user()->id;
            $newNotifikasi->from =  'Profile';
            $newNotifikasi->save();

            return response()->json([
                'msg' => 'Berhasil Update Akun',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'Gagal Update Akun',
                'error' => $th->getMessage()
            ]);
        }

        
    }

    public function guard()
    {
        return Auth::guard('api');
    }


}
