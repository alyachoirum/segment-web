<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use JWTAuth;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
    	//Validate data
        $data = $request->only('name', 'email', 'password');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 401);
        }

        //Request is valid, create new user
        $user = User::create([
        	'name' => $request->name,
        	'email' => $request->email,
        	'password' => bcrypt($request->password)
        ]);

        //User created, return success response
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('nik', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'nik' => 'required',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $faileds = $validator->failed();
            // dd($faileds);
            if(isset($faileds["nik"])){
                return response()->json([
                    'success' => false,
                    'message' => "NIK tidak boleh kosong"], 401);
            }
            if(isset($faileds["password"])){
                if(isset($faileds["password"]["Min"])){
                    return response()->json([
                        'success' => false,
                        'message' => "Password minimal 6 karakter"], 401);
                }
                if(isset($faileds["password"]["Max"])){
                    return response()->json([
                        'success' => false,
                        'message' => "Password maksimal 50 karakter"], 401);
                }
                return response()->json([
                    'success' => false,
                    'message' => "Password tidak boleh kosong"], 401);
            }

            return response()->json([
                'success' => false,
                'message' => "Sedang terjadi kesalahan"], 401);
        }

        //Request is validated
        //Crean token
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                	'success' => false,
                	'message' => 'Login credentials are invalid.',
                ], 401);
            }
        } catch (JWTException $e) {
    	return $credentials;
            return response()->json([
                	'success' => false,
                	'message' => 'Could not create token.',
                ], 500);
        }

 		//Token created, return with success response and jwt token
        return response()->json([
            'success' => true,
            'token' => $token,
            'id_regu'=>Auth::user()->karyawan->id_regu,
            'id_karyawan'=>Auth::user()->karyawan->id_karyawan,
            'nik'=>Auth::user()->nik
        ]);
    }

    public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

		//Request is validated, do logout
        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user]);
    }

    public function notifikasi(Request $request)
    {
        $nik = $request->nik;
        $user = User::where('nik',$nik)->first();
        $notifikasi = DB::table('notifikasis')
            ->where('user_id_penerima', $user->id_user)
            ->orderBy('created_at','desc')
            ->get();
        dd($notifikasi);

    }

    public function get_notifikasi(Request $request)
    {
        $nik = $request->nik;
        $user = User::where('nik',$nik)->first();
        $notifikasi = DB::table('notifikasis')->where('user_id_penerima',$user->id_user)->limit(5)->orderBy('created_at','desc')->get();
        $jumlah_notif = DB::table('notifikasis')->where('user_id_penerima',$user->id_user)->limit(5)->count();

        return response()->json([
            'notifikasi'=>$notifikasi,
            'jumlah_notif'=>$jumlah_notif,
        ]);
    }

    public function change_password(Request $request){
        $data = $request->only('nik', 'password', 'newpassword','confirmpassword');
        
        $validator = Validator::make($data, [
            'nik' => 'required',
            'password' => 'required',
            'newpassword' => 'required',
            'confirmpassword' => 'required',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Kolom isian tidak lengkap',

            ], 400);
        }
        

        try{
            $nik = $request->nik;
            $password = $request->password;
            $newpassword = $request->newpassword;
            $confirmpassword = $request->confirmpassword;
            if($newpassword != $confirmpassword){
                return response()->json([
                    'success' => false,
                    'message' => 'Password baru tidak sama',
    
                ], 400);
            }
            $user = User::where('nik',$nik)->first();
            $cek = Hash::check($password,$user->password);
            if($cek){
                User::where('nik',$nik)->update(['password'=>bcrypt($newpassword)]);
                return response()->json([
                    'success' => true,
                    'message' => 'Sukses mengganti password',
    
                ], 201);

            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Password salah',
    
                ], 400);

            }

        }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Terjadi Kesalahan',
                'error' => $e

            ], 400);
        }
    }
}
