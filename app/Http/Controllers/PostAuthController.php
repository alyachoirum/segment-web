<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PostAuthController extends Controller
{
    public function postauth(Request  $request){

        $nik         = $request->nik;
        $password    = $request->password;
        $remember_me = $request->has('remember_me')? true:false;

        if(Auth::attempt(['nik' => $nik, 'password' => $password], $remember_me)){

            $level_user = Auth::user()->id_level_user;

            if($level_user == '1'){
                toast('Login Sukses','success');
                return redirect('/dashboard_absensi');
            }

            else if($level_user == '2'){
                toast('Login Sukses','success');
                return redirect('/dashboard_absensi');
            }
            else if($level_user == '3'){
                toast('Login Sukses','success');
                return redirect('/dashboard_absensi');
            }
            else if($level_user == '4'){
                toast('Login Sukses','success');
                return redirect('/dashboard_absensi');
            }
            else if($level_user == '5'){
                toast('Login Sukses','success');
                return redirect('/dashboard_absensi');
            }
            else if($level_user == '2'){
                toast('Login Sukses','success');
                return redirect('/dashboard_absensi');
            }
            else if($level_user == '6'){
                toast('Login Sukses','success');
                return redirect('/dashboard_absensi');
            }
            else if($level_user == '7'){
                toast('Login Sukses','success');
                return redirect('/dashboard_absensi');
            }
            else if($level_user == '8'){
                toast('Login Sukses','success');
                return redirect('/dashboard_karyawan');
            }
            else if($level_user == '9'){
                toast('Login Sukses','success');
                return redirect('/dashboard_karyawan');
            }
            else if($level_user == '10'){
                toast('Login Sukses','success');
                return redirect('/dashboard_karyawan');
            }
            else if($level_user == '11'){
                toast('Login Sukses','success');
                return redirect('/dashboard_karyawan');
            }
            else if($level_user == '12'){
                toast('Login Sukses','success');
                return redirect('/dashboard_absensi');
            }
        }

        else{
            Alert::error('NIK / Password Salah','Periksa kembali');
            return back();
        }

    }

    public function reset_password(Request $request)
    {
        alert()->success('Reset Password Berhasil','Cek email masuk atau di spam');
        return redirect('/');
    }

    public function buat_password_baru(Request $request)
    {
        alert()->success('Password Baru Tersimpan');
        return redirect('/');
    }


    public function logout(){
        Auth::logout();
        toast('Anda Telah Logout','info');
        return redirect('/login_absensi');
    }
}
