<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Zona;
use App\Models\Regu;
use App\Models\PresensiLog;
use App\Models\Lembur;
use App\Models\LemburKhusus;
use App\Models\AbsensiLog;
use App\Models\TukarShift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function landing_page()
    {
        $dt_kategori   = DB::table('kategoris')->get();
        $dt_zona       = DB::table('zonas')->get();
        $dt_departemen = DB::table('departemens')->get();

        return view('landing_page',[
            'data_kategori'   => $dt_kategori,
            'data_zona'       => $dt_zona,
            'data_departemen' => $dt_departemen
        ]);

    }

    public function dashboard_eksekutif()
    {
        $datenow = Carbon::now()->isoFormat('Y-MM-D');
        $tanggal = Carbon::now()->isoFormat('D');
        $bulan = Carbon::now()->isoFormat('M');
        $tahun = Carbon::now()->isoFormat('Y');


        $sudah_absen = DB::table('presensi_logs')
                    ->join('users', 'users.nik', '=', 'presensi_logs.nik')
                    ->join('karyawans', 'karyawans.nik', '=', 'presensi_logs.nik')
                    ->join('zonas', 'zonas.id_zona', '=', 'presensi_logs.id_zona')
                    ->join('regus', 'regus.id_regu', '=', 'presensi_logs.id_regu')
                    ->join('jabatans', 'jabatans.id_jabatan', '=', 'presensi_logs.id_jabatan')
                    ->select('users.id_user','presensi_logs.id_presensi','presensi_logs.tanggal','presensi_logs.status','users.foto','karyawans.nik', 'karyawans.nama_lengkap','karyawans.no_hp','zonas.nama_zona','regus.nama_regu','jabatans.nama_jabatan', 'presensi_logs.lat','presensi_logs.lng','presensi_logs.check_in','presensi_logs.check_out',)
                    ->where('presensi_logs.tanggal', $datenow)
                    ->where('presensi_logs.status','=','on_duty')
                    ->get();
        $belum_absen = DB::table('presensi_logs')
                    ->join('users', 'users.nik', '=', 'presensi_logs.nik')
                    ->join('karyawans', 'karyawans.nik', '=', 'presensi_logs.nik')
                    ->join('zonas', 'zonas.id_zona', '=', 'presensi_logs.id_zona')
                    ->join('regus', 'regus.id_regu', '=', 'presensi_logs.id_regu')
                    ->join('jabatans', 'jabatans.id_jabatan', '=', 'presensi_logs.id_jabatan')
                    ->select('users.id_user','presensi_logs.id_presensi','presensi_logs.tanggal','presensi_logs.status','users.foto','karyawans.nik', 'karyawans.nama_lengkap','karyawans.no_hp','zonas.nama_zona','regus.nama_regu','jabatans.nama_jabatan', 'presensi_logs.lat','presensi_logs.lng','presensi_logs.check_in','presensi_logs.check_out',)
                    ->where('presensi_logs.tanggal', $datenow)
                    ->where('presensi_logs.status','=','on_duty')
                    ->get();
        $terlambat = DB::table('presensi_logs')
                    ->join('users', 'users.nik', '=', 'presensi_logs.nik')
                    ->join('karyawans', 'karyawans.nik', '=', 'presensi_logs.nik')
                    ->join('zonas', 'zonas.id_zona', '=', 'presensi_logs.id_zona')
                    ->join('regus', 'regus.id_regu', '=', 'presensi_logs.id_regu')
                    ->join('jabatans', 'jabatans.id_jabatan', '=', 'presensi_logs.id_jabatan')
                    ->select('users.id_user','presensi_logs.id_presensi','presensi_logs.tanggal','presensi_logs.status','users.foto','karyawans.nik', 'karyawans.nama_lengkap','karyawans.no_hp','zonas.nama_zona','regus.nama_regu','jabatans.nama_jabatan', 'presensi_logs.lat','presensi_logs.lng','presensi_logs.check_in','presensi_logs.check_out',)
                    ->where('presensi_logs.tanggal', $datenow)
                    ->where('presensi_logs.status','=','on_duty')
                    ->get();
        $di_lokasi = DB::table('presensi_logs')
                    ->join('users', 'users.nik', '=', 'presensi_logs.nik')
                    ->join('karyawans', 'karyawans.nik', '=', 'presensi_logs.nik')
                    ->join('zonas', 'zonas.id_zona', '=', 'presensi_logs.id_zona')
                    ->join('regus', 'regus.id_regu', '=', 'presensi_logs.id_regu')
                    ->join('jabatans', 'jabatans.id_jabatan', '=', 'presensi_logs.id_jabatan')
                    ->select('users.id_user','presensi_logs.id_presensi','presensi_logs.tanggal','presensi_logs.status','users.foto','karyawans.nik', 'karyawans.nama_lengkap','karyawans.no_hp','zonas.nama_zona','regus.nama_regu','jabatans.nama_jabatan', 'presensi_logs.lat','presensi_logs.lng','presensi_logs.check_in','presensi_logs.check_out',)
                    ->where('presensi_logs.tanggal', $datenow)
                    ->where('presensi_logs.status','=','on_duty')
                    ->get();



        return view('dashboard.dashboard_eksekutif', compact('di_lokasi', 'terlambat', 'belum_absen', 'sudah_absen'));
    }

    public function dashboard_absensi(Regu $regu,Zona $zona, Karyawan $karyawan, PresensiLog $presensilog)
    {
        $datenow = Carbon::now()->isoFormat('Y-MM-D');
        $tanggal = Carbon::now()->isoFormat('D');
        $bulan = Carbon::now()->isoFormat('M');
        $tahun = Carbon::now()->isoFormat('Y');

        $dt_absen = DB::table('presensi_logs')
                    ->join('users', 'users.nik', '=', 'presensi_logs.nik')
                    ->join('karyawans', 'karyawans.nik', '=', 'presensi_logs.nik')
                    ->join('zonas', 'zonas.id_zona', '=', 'presensi_logs.id_zona')
                    ->join('regus', 'regus.id_regu', '=', 'presensi_logs.id_regu')
                    ->join('jabatans', 'jabatans.id_jabatan', '=', 'presensi_logs.id_jabatan')
                    ->select('users.id_user','presensi_logs.id_presensi','presensi_logs.tanggal','presensi_logs.status','users.foto','karyawans.nik', 'karyawans.nama_lengkap','karyawans.no_hp','zonas.nama_zona','regus.nama_regu','jabatans.nama_jabatan', 'presensi_logs.lat','presensi_logs.lng','presensi_logs.check_in','presensi_logs.check_out',)
                    ->where('presensi_logs.tanggal', $datenow)
                    ->where('presensi_logs.status','=','on_duty')
                    ->get();

        if(auth()->user()->karyawan->id_jabatan == 135){
            $dt_zona = $zona::all();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 136){
            $dt_zona = $zona::all();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 1){
            $dt_zona = $zona::all();
        }

        elseif(auth()->user()->id_level_user == 2){
            $dt_zona = DB::table('zonas')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 2){
            $dt_zona = DB::table('zonas')->where('bagian','=','Opsmin')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 3){
            $dt_zona = DB::table('zonas')->where('bagian','=','Kawasan')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 4){
            $dt_zona = DB::table('zonas')->where('bagian','=','Pabrik')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 5){
            $dt_zona = DB::table('zonas')->where('bagian','=','Opsmin')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 6){
            $dt_zona = DB::table('zonas')->where('bagian','=','Pabrik')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 7){
            $dt_zona = DB::table('zonas')->where('bagian','=','Pabrik')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 8){
            $dt_zona = DB::table('zonas')->where('bagian','=','Pabrik')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 9){
            $dt_zona = DB::table('zonas')->where('bagian','=','Pabrik')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 10){
            $dt_zona = DB::table('zonas')->where('bagian','=','Pabrik')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 11){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','TUKS')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 12){
            $dt_zona = DB::table('zonas')->where('bagian','=','Kawasan')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 13){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','Kantor Depkam')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 14){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','Kantor Depkam')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 15){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','Kantor Depkam')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 16){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','TUKS')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 17){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','I')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 18){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','II')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 19){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','III')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 20){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','IV')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 21){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','V')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 22){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','Kantor Depkam')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 23){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','Kantor Depkam')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 24){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','Kantor Depkam')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 25){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','Kantor Depkam')->get();
        }

        elseif(auth()->user()->karyawan->id_jabatan == 26){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','I')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 27){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','I')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 28){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','I')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 29){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','I')->get();
        }


        elseif(auth()->user()->karyawan->id_jabatan == 30){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','II')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 31){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','II')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 32){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','II')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 33){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','II')->get();
        }

        elseif(auth()->user()->karyawan->id_jabatan == 34){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','III')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 35){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','III')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 36){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','III')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 37){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','III')->get();
        }

        elseif(auth()->user()->karyawan->id_jabatan == 38){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','IV')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 39){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','IV')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 40){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','IV')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 41){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','IV')->get();
        }

        elseif(auth()->user()->karyawan->id_jabatan == 42){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','V')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 43){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','V')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 44){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','V')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 45){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','V')->get();
        }

        elseif(auth()->user()->karyawan->id_jabatan == 46){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','TUKS')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 47){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','TUKS')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 48){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','TUKS')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 49){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','TUKS')->get();
        }

        elseif(auth()->user()->karyawan->id_jabatan == 50){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','KAWASAN')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 51){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','KAWASAN')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 52){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','KAWASAN')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 53){
            $dt_zona = DB::table('zonas')->where('nama_zona','=','KAWASAN')->get();
        }

        elseif(auth()->user()->karyawan->id_jabatan == 54){

            $dt_zona = Zona::where(function($q){
                $q->orWhere('nama_zona','=','PA GSARI')
                ->orWhere('nama_zona','=','KANDANGAN')
                ->orWhere('nama_zona', '=','EWS');
            })
            ->get();
        }

        elseif(auth()->user()->karyawan->id_jabatan == 55){
            $dt_zona = Zona::where(function($q){
                $q->orWhere('nama_zona','=','BP LAMONGAN')
                ->orWhere('nama_zona','=','PA BABAT');
            })
            ->get();

        }


        $dt_regu = DB::table('regus')->get();

        $regu_off = DB::table('jadwal_shifts')
                ->select('tanggal', 'bulan', 'tahun', 'id_regu', 'action')
                ->where('tanggal',$tanggal)
                ->where('bulan',$bulan)
                ->where('tahun',$tahun)
                ->where('action','=','OFF')
                ->first();

        $dt_absen_off = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.tgl_lahir','karyawans.alamat','karyawans.no_hp','karyawans.no_ktp','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto')
                ->where('karyawans.id_regu',$regu_off->id_regu)
                ->count();

        foreach($dt_zona as $value){
                $zona =  $value->id_zona;
                $nama_zona = $value->nama_zona;
                $countkaryawan = $karyawan::where('id_zona', $value->id_zona)->select('id_karyawan')->count();
                $count_off_data = $karyawan::where('id_zona', $value->id_zona)->where('id_regu',$regu_off->id_regu)->count();
                $nik = $karyawan::where('id_zona', $value->id_zona)->select('nik')->get();
                $in = $presensilog::where('id_zona', $zona)->where('tanggal', $datenow)->count();
                $out = $countkaryawan-$count_off_data-$in;


                $absensitabel [] = array_merge([
                'nama_zona'=>$nama_zona,
                'zona' => $zona,
                'masuk' => $in,
                'tidakmasuk' => $out,
                'countkaryawan' => $countkaryawan
            ]);
        }


        if(request()->ajax()){
        return datatables()->of($dt_absen)

                ->addColumn('action', function($data){

                        $button =  '<a href=/profile/'.$data->id_user.'>
                                    <button class="btn btn-primary" data-original-title="Detail">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    </a>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        $data_masuk = array_column($absensitabel,'masuk');
        $data_tdk_masuk = array_column($absensitabel,'tidakmasuk');

        //LEMBUR
        if(auth()->user()->id_level_user == 8){
            $data = Lembur::where('nik', auth()->user()->karyawan->nik)->where('terbit',0)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 9){
            $data = Lembur::where('nik', auth()->user()->karyawan->nik )->where('terbit',0)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 10){
            $data = Lembur::where('nik', auth()->user()->karyawan->nik )->where('terbit',0)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 11){
            $data = Lembur::where('nik', auth()->user()->karyawan->nik )->where('terbit',0)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 2){
            $data = Lembur::whereNull('validasi')->orwhereNull('mengetahui')->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 3){
            $data = Lembur::whereNull('validasi')->orwhereNull('mengetahui')->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }

        elseif(auth()->user()->id_level_user == 1){
        $data = Lembur::whereHas('karyawan.jabatan', function($q){
        })
        ->with('karyawan', function($q){
            $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')->with('jabatan', function($q){
                $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
            });
        })
        ->where(function($q){
            $q->whereNull('validasi')->orWhereNull('mengetahui');
        })
        ->orderBy('tgl_lembur', 'desc')
        ->get();
        }
        else{
        $data = Lembur::whereHas('karyawan.jabatan', function($q){
            $q->where('direct_jab_atasan', auth()->user()->karyawan->id_jabatan)->orWhere('direct_jab_atasan_2', auth()->user()->karyawan->id_jabatan);
        })
        ->with('karyawan', function($q){
            $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')->with('jabatan', function($q){
                $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
            });
        })
        ->where(function($q){
            $q->whereNull('validasi')->orWhereNull('mengetahui');
        })
        ->orderBy('tgl_lembur', 'desc')
        ->get();
        }

        //LEMBUR KHUSUS
        if(auth()->user()->karyawan->id_jabatan == 1){
            $lk = LemburKhusus::where('terbit',0)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 2){
            $lk = LemburKhusus::where('klasifikasi_zona','=','OPS&MIN')->whereNull('approve')->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 3){
            $lk = LemburKhusus::where('klasifikasi_zona','=','KAWASAN')->whereNull('approve')->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }

        elseif(auth()->user()->karyawan->id_jabatan == 4){
            $lk = LemburKhusus::where('klasifikasi_zona','=','PABRIK')->whereNull('approve')->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }

        elseif(auth()->user()->id_level_user == 8){
            $lk = LemburKhusus::where('nik', auth()->user()->karyawan->nik)->where('terbit',0)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 9){
            $lk = LemburKhusus::where('nik', auth()->user()->karyawan->nik)->where('terbit',0)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 10){
            $lk = LemburKhusus::where('nik', auth()->user()->karyawan->nik)->where('terbit',0)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 11){
            $lk = LemburKhusus::where('nik', auth()->user()->karyawan->nik)->where('terbit',0)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }

        elseif(auth()->user()->id_level_user == 1){
        $lk = LemburKhusus::whereHas('karyawan.jabatan', function($q){
        })
        ->with('karyawan', function($q){
            $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')->with('jabatan', function($q){
                $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
            });
        })
        ->where(function($q){
            $q->whereNull('validasi')->orWhereNull('mengetahui')->orWhereNull('approve');
        })
        ->orderBy('tgl_lembur_khusus', 'desc')
        ->get();
        }

        else{
        $lk = LemburKhusus::whereHas('karyawan.jabatan', function($q){
            $q->where('direct_jab_atasan', auth()->user()->karyawan->id_jabatan)->orWhere('direct_jab_atasan_2', auth()->user()->karyawan->id_jabatan);
        })
        ->with('karyawan', function($q){
            $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')->with('jabatan', function($q){
                $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
            });
        })
        ->where(function($q){
            $q->whereNull('validasi')->orWhereNull('mengetahui')->orWhereNull('approve');
        })
        ->orderBy('tgl_lembur_khusus', 'desc')
        ->get();
        }

        //ABSEN TIDAK MASUK
        if(auth()->user()->id_level_user == 8){
            $tm = AbsensiLog::where('nik', auth()->user()->karyawan->nik)->where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 9){
            $tm = AbsensiLog::where('nik', auth()->user()->karyawan->nik)->where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 10){
            $tm = AbsensiLog::where('nik', auth()->user()->karyawan->nik)->where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 11){
            $tm = AbsensiLog::where('nik', auth()->user()->karyawan->nik)->where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 2){
            $tm = AbsensiLog::whereNull('validasi')->orwhereNull('mengetahui')->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 3){
            $tm = AbsensiLog::whereNull('validasi')->orwhereNull('mengetahui')->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }

        elseif(auth()->user()->id_level_user == 1){
        $tm = AbsensiLog::whereHas('karyawan.jabatan', function($q){
        })
        ->with('karyawan', function($q){
            $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')->with('jabatan', function($q){
                $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
            });
        })
        ->where(function($q){
            $q->whereNull('validasi')->orWhereNull('mengetahui');
        })
        ->orderBy('tgl_absen', 'desc')
        ->where('terbit',0)
        ->where('reject',0)
        ->get();
        }

        else{
        $tm = AbsensiLog::whereHas('karyawan.jabatan', function($q){
            $q->where('direct_jab_atasan', auth()->user()->karyawan->id_jabatan)->orWhere('direct_jab_atasan_2', auth()->user()->karyawan->id_jabatan);
        })
        ->with('karyawan', function($q){
            $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')->with('jabatan', function($q){
                $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
            });
        })
        ->where(function($q){
            $q->whereNull('validasi')->orWhereNull('mengetahui');
        })
        ->orderBy('tgl_absen', 'desc')
        ->where('terbit',0)
        ->where('reject',0)
        ->get();
        }

        //TUKAR SHIFT
         //SUPERADMIN
        if(auth()->user()->id_level_user == 1){
            // $ts = TukarShift::whereHas('karyawan.jabatan', function($q){
            // })
            // ->with('karyawan', function($q){
            //     $q->select('id_karyawan', 'nik_pihak1', 'id_jabatan', 'nama_lengkap')->with('jabatan', function($q){
            //         $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
            //     });
            // })
            // ->where(function($q){
            //     $q->whereNull('apv_pihak2')->orwhereNull('apv_kajaga_p1')->orwhereNull('apv_kajaga_p2');
            // })
            // ->orderBy('tgl_tukar', 'desc')
            // ->get();
            $ts = TukarShift::whereNull('apv_pihak2')->orwhereNull('apv_kajaga_p1')->orwhereNull('apv_kajaga_p2')->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();

        }
        //ADMIN APK
        elseif(auth()->user()->id_level_user == 12){
            $ts = TukarShift::whereNull('apv_pihak2')->orwhereNull('apv_kajaga_p1')->orwhereNull('apv_kajaga_p2')->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //VP
        elseif(auth()->user()->id_level_user == 2){
            $ts = TukarShift::whereNull('apv_pihak2')->orwhereNull('apv_kajaga_p1')->orwhereNull('apv_kajaga_p2')->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //AVP
        elseif(auth()->user()->id_level_user == 3){
            $ts = TukarShift::whereNull('apv_pihak2')->orwhereNull('apv_kajaga_p1')->orwhereNull('apv_kajaga_p2')->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //SVP
        elseif(auth()->user()->id_level_user == 4){
            $ts = TukarShift::whereNull('apv_pihak2')->orwhereNull('apv_kajaga_p1')->orwhereNull('apv_kajaga_p2')->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //STAFF
        elseif(auth()->user()->id_level_user == 5){
            $ts = TukarShift::where('terbit',0)->where(function($q){
                $q->orWhere('nik_kajaga_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_kajaga_pihak2', auth()->user()->karyawan->nik);
            })
            ->where('reject',0)
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //FOREMAN
        elseif(auth()->user()->id_level_user == 6){
            $ts = TukarShift::where('terbit',0)->where(function($q){
                $q->orWhere('nik_kajaga_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_kajaga_pihak2', auth()->user()->karyawan->nik);
            })
            ->where('reject',0)
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //KAJAGA
        elseif(auth()->user()->id_level_user == 7){
            $ts = TukarShift::where('terbit',0)->where(function($q){
                $q->orWhere('nik_kajaga_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_kajaga_pihak2', auth()->user()->karyawan->nik);
            })
            ->where('reject',0)
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //SATPAM
        elseif(auth()->user()->id_level_user == 8){

            $ts = TukarShift::where('terbit',0)->where(function($q){
                $q->orWhere('nik_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_pihak2', auth()->user()->karyawan->nik);
            })
            ->where('reject',0)
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
            // $data = TukarShift::where('nik_pihak1', auth()->user()->karyawan->nik)->where('terbit',0)->where('reject',0)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();

        }
        //SECURITY
        elseif(auth()->user()->id_level_user == 9){
            $ts = TukarShift::where('terbit',0)->where(function($q){
                $q->orWhere('nik_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_pihak2', auth()->user()->karyawan->nik);
            })
            ->where('reject',0)
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
            // $data = TukarShift::where('nik_pihak1', auth()->user()->karyawan->nik)->where('nik_pihak2', auth()->user()->karyawan->nik)->where('terbit',0)->where('reject',0)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //ADMIN
        elseif(auth()->user()->id_level_user == 11){
            $ts = TukarShift::where('nik_pihak1', auth()->user()->karyawan->nik)->where('terbit',0)->where('reject',0)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }


        $total_tidak_masuk = count($tm);
        $total_tukar_shift = count($ts);
        $total_lembur_khusus = count($lk);
        $total_lembur = count($data);

        return view('dashboard/dashboard_absensi',
            [
                'data_zona' => $dt_zona,
                'data_regu' => $dt_regu
            ]
        , compact('dt_absen','dt_zona','absensitabel', 'data_masuk','data_tdk_masuk','total_lembur','total_lembur_khusus','total_tidak_masuk','total_tukar_shift'));
    }

    public function dashboard_laporan()
    {
        $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.nik', 'karyawans.nama_lengkap','zonas.nama_zona', 'regus.nama_regu','jabatans.nama_jabatan',
                'karyawans.tgl_lahir','karyawans.alamat','karyawans.no_hp','karyawans.no_ktp','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto')
                ->get();

        // $dt_laporan = DB::table('laporans')->get();

        $dt_laporan = DB::table('laporans')
                        ->join('kategoris','kategoris.id_kategori', '=', 'laporans.id_kategori')
                        ->join('users','users.nik', '=', 'laporans.nik')
                        ->join('laporan_buktis','laporan_buktis.id_laporan','=','laporans.id_laporan')
                        ->join('karyawans','karyawans.nik','=','laporans.nik')
                        ->select('laporans.id_laporan','laporans.judul_laporan','kategoris.nama_kategori','kategoris.ikon_kategori','laporans.prioritas',
                        'laporans.kronologi_kejadian','laporans.tingkat','laporans.appv1','laporans.appv2',
                        'laporans.appv3','laporans.publish','laporans.lat','laporans.lng','laporans.created_at',
                        'karyawans.nama_lengkap','users.foto')
                        ->where('laporans.publish',1)
                        ->get();

        return view('dashboard/dashboard_laporan', compact('dt_laporan', 'dt_kar'));
    }

    public function dashboard_avp()
    {

        return view('dashboard.dashboard_avp');
    }

    public function dashboard_spv()
    {

        return view('dashboard.dashboard_spv');
    }

    public function dashboard_kajaga()
    {

        return view('dashboard.dashboard_kajaga');
    }

    public function dashboard_karyawan()
    {

        return view('dashboard.dashboard_karyawan');
    }

    public function dashboard_absensi_filter(Request $request)
    {

        $zona = $request->zona;
        $regu = $request->regu;

        $dt_laporan = DB::table('laporans')->get();

        return view('absensi.lokasi_kehadiran_filter', compact('dt_laporan'));
    }

    public function detail_absen_zona(Request $request)
    {
        $datenow = Carbon::now()->isoFormat('Y-MM-DD');

        $tanggal = Carbon::now()->isoFormat('D');
        $bulan   = Carbon::now()->isoFormat('M');
        $tahun   = Carbon::now()->isoFormat('Y');

        $dt_absen_masuk = DB::table('presensi_logs')
                    ->join('users', 'users.nik', '=', 'presensi_logs.nik')
                    ->join('karyawans', 'karyawans.nik', '=', 'presensi_logs.nik')
                    ->join('zonas', 'zonas.id_zona', '=', 'presensi_logs.id_zona')
                    ->join('regus', 'regus.id_regu', '=', 'presensi_logs.id_regu')
                    ->join('jabatans', 'jabatans.id_jabatan', '=', 'presensi_logs.id_jabatan')
                    ->select('users.id_user','presensi_logs.id_presensi','presensi_logs.tanggal','presensi_logs.status','presensi_logs.jadwal_kerja','users.foto','karyawans.nik', 'karyawans.nama_lengkap','karyawans.no_hp','zonas.nama_zona','regus.nama_regu','jabatans.nama_jabatan', 'presensi_logs.lat','presensi_logs.lng','presensi_logs.check_in','presensi_logs.check_out',)
                    ->where('presensi_logs.tanggal', $datenow)
                    ->whereNotNull('check_in')
                    ->where('zonas.id_zona',$request->id_zona)
                    ->get();

        $regu_off = DB::table('jadwal_shifts')
                ->select('tanggal', 'bulan', 'tahun', 'id_regu', 'action')
                ->where('tanggal',$tanggal)
                ->where('bulan',$bulan)
                ->where('tahun',$tahun)
                ->where('action','=','OFF')
                ->first();

        $dt_absen_off = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.tgl_lahir','karyawans.alamat','karyawans.no_hp','karyawans.no_ktp','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto')
                ->where('karyawans.id_regu',$regu_off->id_regu)
                ->get();

        $dt_absen_tidak_masuk = DB::table('presensi_logs')
                    ->join('users', 'users.nik', '=', 'presensi_logs.nik')
                    ->join('karyawans', 'karyawans.nik', '=', 'presensi_logs.nik')
                    ->join('zonas', 'zonas.id_zona', '=', 'presensi_logs.id_zona')
                    ->join('regus', 'regus.id_regu', '=', 'presensi_logs.id_regu')
                    ->join('jabatans', 'jabatans.id_jabatan', '=', 'presensi_logs.id_jabatan')
                    ->select('users.id_user','presensi_logs.id_presensi','presensi_logs.tanggal','presensi_logs.status','users.foto','karyawans.nik', 'karyawans.nama_lengkap','karyawans.no_hp','zonas.nama_zona','regus.nama_regu','jabatans.nama_jabatan', 'presensi_logs.lat','presensi_logs.lng','presensi_logs.check_in','presensi_logs.check_out',)
                    ->where('presensi_logs.tanggal', $datenow)
                    ->where('zonas.id_zona','=',$request->id_zona)
                    ->get();

        $dt_karyawan = DB::table('karyawans')->where('id_zona',$request->id_zona)->where('status_aktif',1)->get();


        return view('absensi.detail_absen_zona', compact('dt_absen_masuk','dt_absen_tidak_masuk'));
    }


    public function dash_absen()
    {
        $datenow = Carbon::now()->isoFormat('Y-MM-D');
        $tanggal = Carbon::now()->isoFormat('D');
        $bulan = Carbon::now()->isoFormat('M');
        $tahun = Carbon::now()->isoFormat('Y');

        $dt_absen = DB::table('presensi_logs')
                    ->join('users', 'users.nik', '=', 'presensi_logs.nik')
                    ->join('karyawans', 'karyawans.nik', '=', 'presensi_logs.nik')
                    ->join('zonas', 'zonas.id_zona', '=', 'presensi_logs.id_zona')
                    ->join('regus', 'regus.id_regu', '=', 'presensi_logs.id_regu')
                    ->join('jabatans', 'jabatans.id_jabatan', '=', 'presensi_logs.id_jabatan')
                    ->select('users.id_user','presensi_logs.id_presensi','presensi_logs.tanggal','presensi_logs.status','users.foto','karyawans.nik', 'karyawans.nama_lengkap','karyawans.no_hp','zonas.nama_zona','regus.nama_regu','jabatans.nama_jabatan', 'presensi_logs.lat','presensi_logs.lng','presensi_logs.check_in','presensi_logs.check_out',)
                    ->where('presensi_logs.tanggal', $datenow)
                    ->where('presensi_logs.status','=','on_duty')
                    ->get();

        return view('mobile-maps-absen', compact('dt_absen'));
    }
}
