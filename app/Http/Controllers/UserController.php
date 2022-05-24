<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LevelUser;
use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\Notifikasi;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Mockery\Matcher\Not;
use Hashids\Hashids;

class UserController extends Controller
{

    public function data_profile(Request $request, $id)
    {
        $decryptId = Crypt::decryptString($id);
        $user = User::where('id_user',$decryptId)->first();

        $hash = new Hashids();
        $hash_change_password = new Hashids();

        $data_jab = Karyawan::where('nik',$user->nik)->with('jabatan.atasan_1','jabatan.atasan_2')->first();

        $dt_user= DB::table('users')
                        ->join('level_users', 'level_users.id_level_user', '=', 'users.id_level_user')
                        ->join('departemens','departemens.id_departemen','=', 'users.id_departemen')
                        ->join('karyawans','karyawans.nik','=','users.nik')
                        ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan',
                        'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                        'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif',
                        'users.id_user','users.nik','users.password','users.email','users.id_level_user','level_users.nama_level','users.foto','departemens.nama_departemen','users.id_departemen')
                        ->where('users.id_user' ,'=' , $decryptId)
                        ->get();

        $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','jabatans.direct_jab_atasan','jabatans.direct_jab_atasan_2','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->where('users.id_user' ,'=' , $decryptId)
                ->get();

        // $response = Jabatan::with([
        //             'karyawan:id_karyawan,id_jabatan,nama_lengkap',
        //             ])
        //             ->first();
        // dd($response);

        $dt_jab = DB::table('karyawans as personal')
        ->join('jabatans as jab_personal','jab_personal.id_jabatan','=','personal.id_jabatan')
        ->join('jabatans as jab_atasan1','jab_atasan1.id_jabatan','=','jab_personal.direct_jab_atasan')
        ->join('jabatans as jab_atasan2','jab_atasan2.id_jabatan','=','jab_personal.direct_jab_atasan_2')
        ->join('karyawans as atasan1','atasan1.id_jabatan','=','jab_personal.direct_jab_atasan')
        ->join('karyawans as atasan2','atasan2.id_jabatan','=','jab_personal.direct_jab_atasan_2')
        ->select('personal.id_karyawan','personal.id_jabatan',
        'jab_personal.direct_jab_atasan',
        'jab_personal.direct_jab_atasan_2',
        'atasan1.nama_lengkap',
        'atasan2.nama_lengkap')
        ->groupBy('personal.id_karyawan')
        ->get();

        return view('master/profile', compact('hash','hash_change_password'),
        [
            'profile' => $dt_kar,
            'user' => $dt_user,
            'jabatan' => $dt_jab,
            'jab' => $data_jab
        ]);
    }

    public function profile_detail(Request $request)
    {

        $hash = new Hashids();

        $dt_user= DB::table('users')
                        ->join('level_users', 'level_users.id_level_user', '=', 'users.id_level_user')
                        ->join('departemens','departemens.id_departemen','=', 'users.id_departemen')
                        ->join('karyawans','karyawans.nik','=','users.nik')
                        ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan',
                        'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                        'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif',
                        'users.id_user','users.nik','users.password','users.email','users.id_level_user','level_users.nama_level','users.foto','departemens.nama_departemen','users.id_departemen')
                        ->where('users.id_user' ,'=' , $hash->decodeHex($request->id_user))
                        ->get();

        $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->where('users.id_user' ,'=' , $hash->decodeHex($request->id_user))
                ->get();

        // $password =DB::table('users')
        //         ->select('password')
        //         ->where('id_user','=', auth()->user()->id_user)
        //         ->get();

        // $decrypted = Crypt::decrypt($password);

        // dd($decrypted);

        $dt_jabatan = DB::table('jabatans')->get();
        $dt_zona = DB::table('zonas')->get();
        $dt_regu = DB::table('regus')->get();
        $dt_level = DB::table('level_users')->get();
        $dt_departemen = DB::table('departemens')->get();

        return view('master/profile_edit',[
            'profile'       => $dt_kar,
            'user'          => $dt_user,
            'jabatan'       => $dt_jabatan,
            'zona'          => $dt_zona,
            'regu'          => $dt_regu,
            'level'         => $dt_level,
            'departemen'    => $dt_departemen
        ]);
    }



    public function notifikasi(Request $request)
    {
        $id = $request->id_user;

        $decryptId = Crypt::decryptString($id);

        $user = User::where('id_user',$decryptId)->first();

        $notifikasi = DB::table('notifikasis')
                    ->where('user_id_penerima', $user->id_user)
                    ->orderBy('created_at','desc')
                    ->paginate(10);

        return view('master/notifikasi',
        [
            'notifikasi'=>$notifikasi,
        ]);
    }

    public function find_notif(Request $request)
    {
        $search =  $request->input('q');
        if($search!=""){
            $notif = Notifikasi::where(function ($query) use ($search){
                $query->where('judul_notifikasi', 'like', '%'.$search.'%')
                ->orWhere('isi_notifikasi', 'like', '%'.$search.'%')
                ->orWhere('kategori_notifikasi', 'like', '%'.$search.'%')
                ->where('user_id_penerima',auth()->user()->id_user);
            })
            ->orderBy('created_at','desc')
            ->paginate(10);
            $notif->appends(['q' => $search]);
        }
        else{
            $notif = Notifikasi::where('user_id_penerima',auth()->user()->id_user)->orderBy('created_at','desc')->paginate(10);
        }

        return view('master/notifikasi',
        [
            'notifikasi'=>$notif,
        ]);

        // return View('master/notifikasi')->with('data',$notif);

    }

    // public function MarkAsRead_all (Request $request)
    // {
    //     $userUnreadNotification= auth()->user()->unreadNotifications;
    //     if($userUnreadNotification) {
    //         $userUnreadNotification->markAsRead();
    //         return back();
    //     }
    // }

    // public function unreadNotifications_count()
    // {
    //     return auth()->user()->unreadNotifications->count();
    // }

    // public function unreadNotifications()
    // {
    //     foreach (auth()->user()->unreadNotifications as $notification){
    //     return $notification->data['title'];
    //     }
    // }

    public function get_notifikasi(Request $request)
    {
        $notifikasi = DB::table('notifikasis')->where('user_id_penerima',auth()->user()->id_user)->limit(5)->orderBy('created_at','desc')->get();
        $jumlah_notif = DB::table('notifikasis')->where('user_id_penerima',auth()->user()->id_user)->limit(5)->count();

        return response()->json([
            'notifikasi'=>$notifikasi,
            'jumlah_notif'=>$jumlah_notif,
        ]);
    }

    public function data_pelaksana(){
        $dt_akun_pelaksana= DB::table('users')
                        ->join('departemens','departemens.id_departemen', '=', 'users.id_departemen')
                        ->select('users.id_user', 'users.nama_user', 'users.username', 'users.nik',
                        'users.password', 'users.level_user', 'users.foto_profil', 'users.id_departemen', 'departemens.nama_departemen',)
                        ->where('users.level_user' ,'=' ,'Pelaksana')->get();
        $dt_departemen = DB::table('departemens')->get();

        return view('master/akun_pelaksana',
            [
                'data_user' => $dt_akun_pelaksana,
                'data_departemen' => $dt_departemen
            ]);
    }
    public function data_kepala_regu(){
        $dt_akun_kepala_regu = DB::table('users')
                        ->join('departemens','departemens.id_departemen', '=', 'users.id_departemen')
                        ->select('users.id_user', 'users.nama_user', 'users.username', 'users.nik',
                        'users.password', 'users.level_user', 'users.foto_profil', 'users.id_departemen', 'departemens.nama_departemen',)
                        ->where('users.level_user' ,'=' ,'Kepala Regu')->get();
        $dt_departemen = DB::table('departemens')->get();

        return view('master/akun_kepala_regu',
            [
                'data_user' => $dt_akun_kepala_regu,
                'data_departemen' => $dt_departemen
            ]);
    }
    public function data_kepala_seksi(){
        $dt_akun_kepala_seksi = DB::table('users')
                        ->join('departemens','departemens.id_departemen', '=', 'users.id_departemen')
                        ->select('users.id_user', 'users.nama_user', 'users.username', 'users.nik',
                        'users.password', 'users.level_user', 'users.foto_profil', 'users.id_departemen', 'departemens.nama_departemen',)
                        ->where('users.level_user' ,'=' ,'Kepala Seksi')->get();
        $dt_departemen = DB::table('departemens')->get();

        return view('master/akun_kepala_seksi',
            [
                'data_user' => $dt_akun_kepala_seksi,
                'data_departemen' => $dt_departemen
            ]);
    }
    public function data_kepala_bagian(){
        $dt_akun_kepala_bagian = DB::table('users')
                        ->join('departemens','departemens.id_departemen', '=', 'users.id_departemen')
                        ->select('users.id_user', 'users.nama_user', 'users.username', 'users.nik',
                        'users.password', 'users.level_user', 'users.foto_profil', 'users.id_departemen', 'departemens.nama_departemen',)
                        ->where('users.level_user' ,'=' ,'Kepala Bagian')->get();
        $dt_departemen = DB::table('departemens')->get();


        return view('master/akun_kepala_bagian',
            [
                'data_user' => $dt_akun_kepala_bagian,
                'data_departemen' => $dt_departemen
            ]);
    }

    public function data_super_admin(){

        $dt_akun= DB::table('users')
                        ->join('level_users', 'level_users.id_level_user', '=', 'users.id_level_user')
                        ->join('departemens','departemens.id_departemen','=', 'users.id_departemen')
                        ->join('karyawans','karyawans.nik','=','users.nik')
                        ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan',
                        'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                        'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif',
                        'users.id_user','users.nik','users.password','users.email','users.id_level_user','level_users.nama_level','users.foto','departemens.nama_departemen','users.id_departemen')
                        ->where('users.id_level_user' ,'=' , 1)->get();

        $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->where('users.id_level_user' ,'=' , 1)->get();

        $dt_jabatan = DB::table('jabatans')->get();
        $dt_zona = DB::table('zonas')->get();
        $dt_regu = DB::table('regus')->get();
        $dt_level = DB::table('level_users')->get();
        $dt_departemen = DB::table('departemens')->get();

        if(request()->ajax()){
        return datatables()->of($dt_akun)

                ->addColumn('action', function($data){

                    $button =  '<a href=/profile/'.$data->id_user.'>
                                <button class="btn btn-primary" data-original-title="Detail">
                                    <i class="fa fa-eye"></i>
                                </button>
                                </a>';
                    $button .= '<a href=/profile_detail/'.$data->id_user.'>
                                    <button class="btn btn-primary" data-original-title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </a>';
                    $button .= ' <a href=/profile/'.$data->id_user.'>
                                    <button class="btn btn-primary" data-toggle="modal" data-original-title="Hapus" data-target="#delete{{$user->id_user}}">
                                        <i class="fa fa-eraser"></i>
                                    </button>
                                </a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('master/akun_super_admin',
            [
                'data_user' => $dt_akun,
                'data_kar' => $dt_kar,
                'data_departemen' => $dt_departemen,
                'jabatan'       => $dt_jabatan,
                'zona'          => $dt_zona,
                'regu'          => $dt_regu,
                'level'         => $dt_level,
            ]);
    }

    public function data_vp(){
        $dt_akun= DB::table('users')
                        ->join('level_users', 'level_users.id_level_user', '=', 'users.id_level_user')
                        ->join('departemens','departemens.id_departemen','=', 'users.id_departemen')
                        ->join('karyawans','karyawans.nik','=','users.nik')
                        ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan',
                        'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                        'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif',
                        'users.id_user','users.nik','users.password','users.email','users.id_level_user','level_users.nama_level','users.foto','departemens.nama_departemen','users.id_departemen')
                        ->where('users.id_level_user' ,'=' , 2)->get();

        $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->where('users.id_level_user' ,'=' , 2)->get();

        $dt_jabatan = DB::table('jabatans')->get();
        $dt_zona = DB::table('zonas')->get();
        $dt_regu = DB::table('regus')->get();
        $dt_level = DB::table('level_users')->get();
        $dt_departemen = DB::table('departemens')->get();

        if(request()->ajax()){
        return datatables()->of($dt_akun)

                ->addColumn('action', function($data){

                    $button =  '<a href=/profile/'.$data->id_user.'>
                                <button class="btn btn-primary" data-original-title="Detail">
                                    <i class="fa fa-eye"></i>
                                </button>
                                </a>';
                    $button .= '<a href=/profile_detail/'.$data->id_user.'>
                                    <button class="btn btn-primary" data-original-title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </a>';
                    $button .= ' <a href=/profile/'.$data->id_user.'>
                                    <button class="btn btn-primary" data-toggle="modal" data-original-title="Hapus" data-target="#delete{{$user->id_user}}">
                                        <i class="fa fa-eraser"></i>
                                    </button>
                                </a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('master/akun_vp',
            [
                'data_user' => $dt_akun,
                'data_kar' => $dt_kar,
                'data_departemen' => $dt_departemen,
                'jabatan'       => $dt_jabatan,
                'zona'          => $dt_zona,
                'regu'          => $dt_regu,
                'level'         => $dt_level,
            ]);
    }

    public function data_avp(){
        $dt_akun= DB::table('users')
                        ->join('level_users', 'level_users.id_level_user', '=', 'users.id_level_user')
                        ->join('departemens','departemens.id_departemen','=', 'users.id_departemen')
                        ->join('karyawans','karyawans.nik','=','users.nik')
                        ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan',
                        'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                        'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif',
                        'users.id_user','users.nik','users.password','users.email','users.id_level_user','level_users.nama_level','users.foto','departemens.nama_departemen','users.id_departemen')
                        ->where('users.id_level_user' ,'=' , 3)->get();

        $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->where('users.id_level_user' ,'=' , 3)->get();

        $dt_jabatan = DB::table('jabatans')->get();
        $dt_zona = DB::table('zonas')->get();
        $dt_regu = DB::table('regus')->get();
        $dt_level = DB::table('level_users')->get();
        $dt_departemen = DB::table('departemens')->get();

        if(request()->ajax()){
        return datatables()->of($dt_akun)

                ->addColumn('action', function($data){

                    $button =  '<a href=/profile/'.Crypt::encryptString($data->id_user).'>
                                <button class="btn btn-primary" data-original-title="Detail">
                                    <i class="fa fa-eye"></i>
                                </button>
                                </a>';

                    // $button =  '<a href=/profile/'.$data->id_user.'>
                    //             <button class="btn btn-primary" data-original-title="Detail">
                    //                 <i class="fa fa-eye"></i>
                    //             </button>
                    //             </a>';
                    // $button .= '<a href=/profile_detail/'.$data->id_user.'>
                    //                 <button class="btn btn-primary" data-original-title="Edit">
                    //                     <i class="fa fa-edit"></i>
                    //                 </button>
                    //             </a>';
                    // $button .= ' <a href=/profile/'.$data->id_user.'>
                    //                 <button class="btn btn-primary" data-toggle="modal" data-original-title="Hapus" data-target="#delete{{$user->id_user}}">
                    //                     <i class="fa fa-eraser"></i>
                    //                 </button>
                    //             </a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('master/akun_avp',
            [
                'data_user' => $dt_akun,
                'data_kar' => $dt_kar,
                'data_departemen' => $dt_departemen,
                'jabatan'       => $dt_jabatan,
                'zona'          => $dt_zona,
                'regu'          => $dt_regu,
                'level'         => $dt_level,
            ]);
    }
    public function data_supervisor(){
        $dt_akun= DB::table('users')
                        ->join('level_users', 'level_users.id_level_user', '=', 'users.id_level_user')
                        ->join('departemens','departemens.id_departemen','=', 'users.id_departemen')
                        ->join('karyawans','karyawans.nik','=','users.nik')
                        ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan',
                        'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                        'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif',
                        'users.id_user','users.nik','users.password','users.email','users.id_level_user','level_users.nama_level','users.foto','departemens.nama_departemen','users.id_departemen')
                        ->where('users.id_level_user' ,'=' , 4)->get();

        $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->where('users.id_level_user' ,'=' , 4)->get();

        $dt_jabatan = DB::table('jabatans')->get();
        $dt_zona = DB::table('zonas')->get();
        $dt_regu = DB::table('regus')->get();
        $dt_level = DB::table('level_users')->get();
        $dt_departemen = DB::table('departemens')->get();

        if(request()->ajax()){
        return datatables()->of($dt_akun)

                ->addColumn('action', function($data){
                    $button =  '<a href=/profile/'.Crypt::encryptString($data->id_user).'>
                                <button class="btn btn-primary" data-original-title="Detail">
                                    <i class="fa fa-eye"></i>
                                </button>
                                </a>';

                    // $button =  '<a href=/profile/'.$data->id_user.'>
                    //             <button class="btn btn-primary" data-original-title="Detail">
                    //                 <i class="fa fa-eye"></i>
                    //             </button>
                    //             </a>';
                    // $button .= '<a href=/profile_detail/'.$data->id_user.'>
                    //                 <button class="btn btn-primary" data-original-title="Edit">
                    //                     <i class="fa fa-edit"></i>
                    //                 </button>
                    //             </a>';
                    // $button .= ' <a href=/profile/'.$data->id_user.'>
                    //                 <button class="btn btn-primary" data-toggle="modal" data-original-title="Hapus" data-target="#delete{{$user->id_user}}">
                    //                     <i class="fa fa-eraser"></i>
                    //                 </button>
                    //             </a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('master/akun_supervisor',
            [
                'data_user' => $dt_akun,
                'data_kar' => $dt_kar,
                'data_departemen' => $dt_departemen,
                'jabatan'       => $dt_jabatan,
                'zona'          => $dt_zona,
                'regu'          => $dt_regu,
                'level'         => $dt_level,
            ]);
    }
    public function data_staff(){
        $dt_akun= DB::table('users')
                        ->join('level_users', 'level_users.id_level_user', '=', 'users.id_level_user')
                        ->join('departemens','departemens.id_departemen','=', 'users.id_departemen')
                        ->join('karyawans','karyawans.nik','=','users.nik')
                        ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan',
                        'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                        'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif',
                        'users.id_user','users.nik','users.password','users.email','users.id_level_user','level_users.nama_level','users.foto','departemens.nama_departemen','users.id_departemen')
                        ->where('users.id_level_user' ,'=' , 5)->get();

        $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->where('users.id_level_user' ,'=' , 5)->get();

        $dt_jabatan = DB::table('jabatans')->get();
        $dt_zona = DB::table('zonas')->get();
        $dt_regu = DB::table('regus')->get();
        $dt_level = DB::table('level_users')->get();
        $dt_departemen = DB::table('departemens')->get();

        if(request()->ajax()){
        return datatables()->of($dt_akun)

                ->addColumn('action', function($data){

                    $button =  '<a href=/profile/'.$data->id_user.'>
                                <button class="btn btn-primary" data-original-title="Detail">
                                    <i class="fa fa-eye"></i>
                                </button>
                                </a>';
                    $button .= '<a href=/profile_detail/'.$data->id_user.'>
                                    <button class="btn btn-primary" data-original-title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </a>';
                    $button .= ' <a href=/profile/'.$data->id_user.'>
                                    <button class="btn btn-primary" data-toggle="modal" data-original-title="Hapus" data-target="#delete{{$user->id_user}}">
                                        <i class="fa fa-eraser"></i>
                                    </button>
                                </a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }


        return view('master/akun_staff',
            [
                'data_user' => $dt_akun,
                'data_kar' => $dt_kar,
                'data_departemen' => $dt_departemen,
                'jabatan'       => $dt_jabatan,
                'zona'          => $dt_zona,
                'regu'          => $dt_regu,
                'level'         => $dt_level,
            ]);
    }
    public function data_foreman(){
        $dt_akun= DB::table('users')
                        ->join('level_users', 'level_users.id_level_user', '=', 'users.id_level_user')
                        ->join('departemens','departemens.id_departemen','=', 'users.id_departemen')
                        ->join('karyawans','karyawans.nik','=','users.nik')
                        ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan',
                        'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                        'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif',
                        'users.id_user','users.nik','users.password','users.email','users.id_level_user','level_users.nama_level','users.foto','departemens.nama_departemen','users.id_departemen')
                        ->where('users.id_level_user' ,'=' , 6)->get();

        $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->where('users.id_level_user' ,'=' , 6)->get();

        $dt_jabatan = DB::table('jabatans')->get();
        $dt_zona = DB::table('zonas')->get();
        $dt_regu = DB::table('regus')->get();
        $dt_level = DB::table('level_users')->get();
        $dt_departemen = DB::table('departemens')->get();

        if(request()->ajax()){
        return datatables()->of($dt_akun)

                ->addColumn('action', function($data){

                    $button =  '<a href=/profile/'.$data->id_user.'>
                                <button class="btn btn-primary" data-original-title="Detail">
                                    <i class="fa fa-eye"></i>
                                </button>
                                </a>';
                    $button .= '<a href=/profile_detail/'.$data->id_user.'>
                                    <button class="btn btn-primary" data-original-title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </a>';
                    $button .= ' <a href=/profile/'.$data->id_user.'>
                                    <button class="btn btn-primary" data-toggle="modal" data-original-title="Hapus" data-target="#delete{{$user->id_user}}">
                                        <i class="fa fa-eraser"></i>
                                    </button>
                                </a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('master/akun_foreman',
            [
                'data_user' => $dt_akun,
                'data_kar' => $dt_kar,
                'data_departemen' => $dt_departemen,
                'jabatan'       => $dt_jabatan,
                'zona'          => $dt_zona,
                'regu'          => $dt_regu,
                'level'         => $dt_level
            ]);
    }
    public function data_kajaga(){

        $dt_akun= DB::table('users')
                        ->join('level_users', 'level_users.id_level_user', '=', 'users.id_level_user')
                        ->join('departemens','departemens.id_departemen','=', 'users.id_departemen')
                        ->join('karyawans','karyawans.nik','=','users.nik')
                        ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan',
                        'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                        'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif',
                        'users.id_user','users.nik','users.password','users.email','users.id_level_user','level_users.nama_level','users.foto','departemens.nama_departemen','users.id_departemen')
                        ->where('users.id_level_user' ,'=' , 7)->get();

        $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->where('users.id_level_user' ,'=' , 7)->get();

        $dt_jabatan = DB::table('jabatans')->get();
        $dt_zona = DB::table('zonas')->get();
        $dt_regu = DB::table('regus')->get();
        $dt_level = DB::table('level_users')->get();
        $dt_departemen = DB::table('departemens')->get();

        if(request()->ajax()){
        return datatables()->of($dt_akun)

                ->addColumn('action', function($data){

                    $button =  '<a href=/profile/'.$data->id_user.'>
                                <button class="btn btn-primary" data-original-title="Detail">
                                    <i class="fa fa-eye"></i>
                                </button>
                                </a>';
                    $button .= '<a href=/profile_detail/'.$data->id_user.'>
                                    <button class="btn btn-primary" data-original-title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </a>';
                    $button .= ' <a href=/profile/'.$data->id_user.'>
                                    <button class="btn btn-primary" data-toggle="modal" data-original-title="Hapus" data-target="#delete{{$user->id_user}}">
                                        <i class="fa fa-eraser"></i>
                                    </button>
                                </a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('master/akun_kajaga',
            [
                'data_user' => $dt_akun,
                'data_kar' => $dt_kar,
                'data_departemen' => $dt_departemen,
                'jabatan'       => $dt_jabatan,
                'zona'          => $dt_zona,
                'regu'          => $dt_regu,
                'level'         => $dt_level,
            ]);
    }
    public function data_security(){
        $dt_akun= DB::table('users')
                        ->join('level_users', 'level_users.id_level_user', '=', 'users.id_level_user')
                        ->join('departemens','departemens.id_departemen','=', 'users.id_departemen')
                        ->join('karyawans','karyawans.nik','=','users.nik')
                        ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan',
                        'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                        'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif',
                        'users.id_user','users.nik','users.password','users.email','users.id_level_user','level_users.nama_level','users.foto','departemens.nama_departemen','users.id_departemen')
                        ->where('users.id_level_user' ,'=' , 9)->get();

        $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->where('users.id_level_user' ,'=' , 9)->get();

        $dt_jabatan = DB::table('jabatans')->get();
        $dt_zona = DB::table('zonas')->get();
        $dt_regu = DB::table('regus')->get();
        $dt_level = DB::table('level_users')->get();
        $dt_departemen = DB::table('departemens')->get();

        if(request()->ajax()){
        return datatables()->of($dt_akun)

                ->addColumn('action', function($data){

                    $button =  '<a href=/profile/'.$data->id_user.'>
                                <button class="btn btn-primary" data-original-title="Detail">
                                    <i class="fa fa-eye"></i>
                                </button>
                                </a>';
                    $button .= '<a href=/profile_detail/'.$data->id_user.'>
                                    <button class="btn btn-primary" data-original-title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </a>';
                    $button .= ' <a href=/profile/'.$data->id_user.'>
                                    <button class="btn btn-primary" data-toggle="modal" data-original-title="Hapus" data-target="#delete{{$user->id_user}}">
                                        <i class="fa fa-eraser"></i>
                                    </button>
                                </a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('master/akun_security',
            [
                'data_user' => $dt_akun,
                'data_kar' => $dt_kar,
                'data_departemen' => $dt_departemen,
                'jabatan'       => $dt_jabatan,
                'zona'          => $dt_zona,
                'regu'          => $dt_regu,
                'level'         => $dt_level,
            ]);
    }
    public function data_satpam(){

        $dt_akun= DB::table('users')
                        ->join('level_users', 'level_users.id_level_user', '=', 'users.id_level_user')
                        ->join('departemens','departemens.id_departemen','=', 'users.id_departemen')
                        ->join('karyawans','karyawans.nik','=','users.nik')
                        ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan',
                        'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                        'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif',
                        'users.id_user','users.nik','users.password','users.email','users.id_level_user','level_users.nama_level','users.foto','departemens.nama_departemen','users.id_departemen')
                        ->where('users.id_level_user' ,'=' , 8)->get();

        $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->where('users.id_level_user' ,'=' , 8)->get();

        $dt_jabatan = DB::table('jabatans')->get();
        $dt_zona = DB::table('zonas')->get();
        $dt_regu = DB::table('regus')->get();
        $dt_level = DB::table('level_users')->get();
        $dt_departemen = DB::table('departemens')->get();

        if(request()->ajax()){
        return datatables()->of($dt_akun)

                ->addColumn('action', function($data){

                    $button =  '<a href=/profile/'.Crypt::encryptString($data->id_user).'>
                                <button class="btn btn-primary" data-original-title="Detail">
                                    <i class="fa fa-eye"></i>
                                </button>
                                </a>';
                    // $button .= '<a href=/profile_detail/'.$data->id_user.'>
                    //                 <button class="btn btn-primary" data-original-title="Edit">
                    //                     <i class="fa fa-edit"></i>
                    //                 </button>
                    //             </a>';
                    // $button .= ' <a href=/profile/'.$data->id_user.'>
                    //                 <button class="btn btn-primary" data-toggle="modal" data-original-title="Hapus" data-target="#delete{{$user->id_user}}">
                    //                     <i class="fa fa-eraser"></i>
                    //                 </button>
                    //             </a>';


                    // if($data->id_jabatan == 125){
                    // $button =  '<a href=/profile/'.$data->id_user.'>
                    //             <button class="btn btn-primary" data-original-title="Detail">
                    //                 <i class="fa fa-eye"></i>
                    //             </button>
                    //             </a>';
                    // $button .= '<a href=/profile_detail/'.$data->id_user.'>
                    //                 <button class="btn btn-primary" data-original-title="Edit">
                    //                     <i class="fa fa-edit"></i>
                    //                 </button>
                    //             </a>';
                    // $button .= ' <a href=/profile/'.$data->id_user.'>
                    //                 <button class="btn btn-primary" data-toggle="modal" data-original-title="Hapus" data-target="#delete{{$user->id_user}}">
                    //                     <i class="fa fa-eraser"></i>
                    //                 </button>
                    //             </a>';
                    // }
                    // elseif($data->id_jabatan == 1 && $data->id_jabatan == 2){
                    // $button =  '<a href=/profile/'.$data->id_user.'>
                    //             <button class="btn btn-primary" data-original-title="Detail">
                    //                 <i class="fa fa-eye"></i>
                    //             </button>
                    //             </a>';
                    // $button .= '<a href=/profile_detail/'.$data->id_user.'>
                    //                 <button class="btn btn-primary" data-original-title="Edit">
                    //                     <i class="fa fa-edit"></i>
                    //                 </button>
                    //             </a>';
                    // $button .= ' <a href=/profile/'.$data->id_user.'>
                    //                 <button class="btn btn-primary" data-toggle="modal" data-original-title="Hapus" data-target="#delete{{$user->id_user}}">
                    //                     <i class="fa fa-eraser"></i>
                    //                 </button>
                    //             </a>';
                    // }

                    // else {
                    // $button =  '<a href=https://api.whatsapp.com/send/?phone=%2B62'.$data->no_hp.'&text&app_absent=0>
                    //             <button class="btn btn-primary" data-original-title="Detail">
                    //                 <i class="fa fa-phone-square"></i>
                    //             </button>
                    //             </a>';
                    // }

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('master/akun_satpam',
            [
                'data_user' => $dt_akun,
                'data_kar' => $dt_kar,
                'data_departemen' => $dt_departemen,
                'jabatan'       => $dt_jabatan,
                'zona'          => $dt_zona,
                'regu'          => $dt_regu,
                'level'         => $dt_level,
            ]);
    }

    public function data_pamtup(){
        $dt_akun= DB::table('users')
                        ->join('level_users', 'level_users.id_level_user', '=', 'users.id_level_user')
                        ->join('departemens','departemens.id_departemen','=', 'users.id_departemen')
                        ->join('karyawans','karyawans.nik','=','users.nik')
                        ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan',
                        'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                        'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif',
                        'users.id_user','users.nik','users.password','users.email','users.id_level_user','level_users.nama_level','users.foto','departemens.nama_departemen','users.id_departemen')
                        ->where('users.id_level_user' ,'=' , 10)
                        ->get();

        $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->where('users.id_level_user' ,'=' , 10)
                ->get();

        $dt_jabatan = DB::table('jabatans')->get();
        $dt_zona = DB::table('zonas')->get();
        $dt_regu = DB::table('regus')->get();
        $dt_level = DB::table('level_users')->get();
        $dt_departemen = DB::table('departemens')->get();

        if(request()->ajax()){
        return datatables()->of($dt_akun)

                ->addColumn('action', function($data){

                    $button =  '<a href=/profile/'.$data->id_user.'>
                                <button class="btn btn-primary" data-original-title="Detail">
                                    <i class="fa fa-eye"></i>
                                </button>
                                </a>';
                    $button .= '<a href=/profile_detail/'.$data->id_user.'>
                                    <button class="btn btn-primary" data-original-title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </a>';
                    $button .= ' <a href=/profile/'.$data->id_user.'>
                                    <button class="btn btn-primary" data-toggle="modal" data-original-title="Hapus" data-target="#delete{{$user->id_user}}">
                                        <i class="fa fa-eraser"></i>
                                    </button>
                                </a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        return view('master/akun_pamtup',
            [
                'data_user' => $dt_akun,
                'data_kar' => $dt_kar,
                'data_departemen' => $dt_departemen,
                'jabatan'       => $dt_jabatan,
                'zona'          => $dt_zona,
                'regu'          => $dt_regu,
                'level'         => $dt_level,
            ]);
    }

    public function data_admin(){
        $dt_akun= DB::table('users')
                        ->join('level_users', 'level_users.id_level_user', '=', 'users.id_level_user')
                        ->join('departemens','departemens.id_departemen','=', 'users.id_departemen')
                        ->join('karyawans','karyawans.nik','=','users.nik')
                        ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan',
                        'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                        'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif',
                        'users.id_user','users.nik','users.password','users.email','users.id_level_user','level_users.nama_level','users.foto','departemens.nama_departemen','users.id_departemen')
                        ->where('users.id_level_user' ,'=' , 11)->get();

        $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->where('users.id_level_user' ,'=' , 11)->get();

        if(request()->ajax()){
        return datatables()->of($dt_akun)

                ->addColumn('action', function($data){

                    $button =  '<a href=/profile/'.$data->id_user.'>
                                <button class="btn btn-primary" data-original-title="Detail">
                                    <i class="fa fa-eye"></i>
                                </button>
                                </a>';
                    $button .= '<a href=/profile_detail/'.$data->id_user.'>
                                    <button class="btn btn-primary" data-original-title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </a>';
                    $button .= '<button type="button" name="delete" id="'.$data->id_user.'" class="delete btn btn-primary">
                                        <i class="fa fa-eraser"></i>
                                </button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        $dt_jabatan = DB::table('jabatans')->get();
        $dt_zona = DB::table('zonas')->get();
        $dt_regu = DB::table('regus')->get();
        $dt_level = DB::table('level_users')->get();
        $dt_departemen = DB::table('departemens')->get();

        return view('master/akun_admin',
            [
                'data_user' => $dt_akun,
                'data_kar' => $dt_kar,
                'data_departemen' => $dt_departemen,
                'jabatan'       => $dt_jabatan,
                'zona'          => $dt_zona,
                'regu'          => $dt_regu,
                'level'         => $dt_level,
            ]);
    }


    public function tambah_user(Request $request)
    {
        if($request->hasFile('gambar')){
            $gambar_profil = $request->file('gambar');
            $gambar = rand() . '.' . $gambar_profil->getClientOriginalExtension();
            $gambar_profil->move(public_path('assets/foto_profil'), $gambar);
        }
        else{
            $gambar = 'default.png';
        }

        $user                   = new User();
        $user->nik              = $request->nik;
        $user->nama_user        = $request->nama_user;
        $user->username         = $request->username;
        $user->password         = Hash::make($request->password);
        $user->level_user       = $request->level_user;
        $user->id_departemen    = $request->id_departemen;
        $user->foto_profil      = $gambar;
        $user->save();
        return redirect()->back()->with('success', 'Tambah User Berhasil');
    }

    public function profile_edit(Request $request)
    {

        if($request->hasFile('foto')){
            $gambar_profil = $request->file('foto');
            $gambar = rand() . '.' . $gambar_profil->getClientOriginalExtension();
            $gambar_profil->move(public_path('assets/foto_profil'), $gambar);
        }

        else{
            $gambar = $request->foto_profil;
        }

            $tgl = $request->tgl_lahir;
            if($tgl == null){
                $tgl_lahir = null;
            }
            else{
                $tgl_lahir = date("Y-m-d", strtotime($tgl));
            }

            $tgl_jatuh_tempo = $request->tgl_jatuhtempo_gada;
            if($tgl_jatuh_tempo == null){
                $tgl_jatuhtempo_gada = null;
            }
            else{
                $tgl_jatuhtempo_gada = date("Y-m-d", strtotime($tgl_jatuh_tempo));
            }

            Karyawan::where('id_karyawan', $request->id_karyawan)->update([
                'nik'                   => $request->nik,
                'nama_lengkap'          => $request->nama_lengkap,
                'id_zona'               => $request->id_zona,
                'id_regu'               => $request->id_regu,
                'id_jabatan'            => $request->id_jabatan,
                'pt'                    => $request->pt,
                'no_kib'                => $request->no_kib,
                'tgl_lahir'             => $tgl_lahir,
                'alamat'                => $request->alamat,
                'rtrw'                  => $request->rtrw,
                'desa'                  => $request->desa,
                'kecamatan'             => $request->kecamatan,
                'kabupaten'             => $request->kabupaten,
                'no_hp'                 => $request->no_hp,
                'no_ktp'                => $request->no_ktp,
                'kompetensi_gada'       => $request->kompetensi_gada,
                'no_reg'                => $request->no_reg,
                'no_kta'                => $request->no_kta,
                'no_ijazah'             => $request->no_ijazah,
                'tgl_jatuhtempo_gada'   => $tgl_jatuhtempo_gada,
                'status_aktif'          => $request->status_aktif,
            ]);

            User::where('id_user', $request->id_user)->update([
                'nik' => $request->nik,
                'email' => $request->email,
                'id_level_user' => $request->id_level_user,
                'foto' => $gambar,
                'id_departemen' => $request->id_departemen
            ]);

            return redirect()->back()->with('edit_success', 'Edit User Berhasil');


    }

    public function change_password(Request $request)
    {

        $hash_change_password = new Hashids();


        $dt_user= DB::table('users')
                        ->join('level_users', 'level_users.id_level_user', '=', 'users.id_level_user')
                        ->join('departemens','departemens.id_departemen','=', 'users.id_departemen')
                        ->join('karyawans','karyawans.nik','=','users.nik')
                        ->select('karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan',
                        'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                        'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif',
                        'users.id_user','users.nik','users.password','users.email','users.id_level_user','level_users.nama_level','users.foto','departemens.nama_departemen','users.id_departemen')
                        ->where('users.id_user' ,'=' , $hash_change_password->decodeHex($request->id_user))
                        ->get();

        return view('master/change_password', [
            // 'user' => $dt_user,
        ]);
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();

        $userPassword = $user->password;

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|same:confirm_password|min:6',
            'confirm_password' => 'required',
        ]);

        if (!Hash::check($request->current_password, $userPassword)) {
            return back()->withErrors(['current_password'=>'password not match']);
        }

        $user->password = Hash::make($request->password);

        $user->save();

        alert()->success('Ganti Password Berhasil');
        return redirect()->back();
    }

    public function delete_user($id)
    {
        $delete = User::where('id_user', $id)->delete();
        $delete = Karyawan::where('id_karyawan', $id)->delete();

        return response()->json($delete);

        // $delete = User::where('id_user', $request->id_user);
        // $delete->delete($delete);
        // return redirect()->back()->with('hapus_success', 'Hapus User Berhasil');
    }
}
