<?php

namespace App\Http\Controllers;

use App\Models\AbsensiLog;
use App\Models\Bulan;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Karyawan;
use App\Models\PresensiLog;
use App\Models\Lembur;
use App\Models\Jabatan;
use App\Models\JadwalShift;
use App\Models\LemburKhusus;
use App\Models\Notifikasi;
use App\Models\Zona;
use App\Models\Regu;
use App\Models\TukarShift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use DateTime;
use Stevebauman\Location\Facades\Location;
use Hashids\Hashids;

use function PHPUnit\Framework\isNull;

class AbsensiController extends Controller
{
    public function data_karyawan(){

        // $dt_jabatan = DB::table('jabatans')->get();
        $zona = DB::table('zonas')->get();
        // $dt_regu = DB::table('regus')->get();
        // $dt_level = DB::table('level_users')->get();
        // $dt_departemen = DB::table('departemens')->get();

        $data_karyawan = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.tgl_lahir','karyawans.alamat','karyawans.no_hp','karyawans.no_ktp','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto')
                ->get();

        // $data_karyawan = Karyawan::all()
        //                 ->with(['regu:id_regu,nama_regu','zona:id_zona,nama_zona','jabatan:id_jabatan,nama_jabatan'])
        //                 ->first();

        if(request()->ajax()){
            return datatables()->of($data_karyawan)
                        ->addColumn('action', function($data){

                            $button =  '<a href=https://api.whatsapp.com/send/?phone=%2B62'.$data->no_hp.'&text&app_absent=0>
                                <button class="btn btn-primary" data-original-title="Detail">
                                    <i class="fa fa-phone-square"></i>
                                </button>
                                </a>';

                            // $button .= '<a href=/profile_detail/'.$data->id_karyawan.' data-toggle="tooltip" class="btn btn-inverse-info btn-icon" >
                            //             <i class="mdi mdi-information"></i>
                            //             </a>';
                            return $button;
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        }


        return view('absensi/data_karyawan', compact('data_karyawan','zona'));
    }

    public function data_karyawan_filter(Request $request)
    {

        $data_karyawan_filter = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.tgl_lahir','karyawans.alamat','karyawans.no_hp','karyawans.no_ktp','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto')
                ->where('karyawans.id_zona','=', $request->id_zona)
                ->get();

            // dd($data_karyawan);

        $zona = DB::table('zonas')->get();

        if(request()->ajax()){
            return datatables()->of($data_karyawan_filter)
                        ->addColumn('action', function($data_karyawan_filter){

                            $button =  '<a href=https://api.whatsapp.com/send/?phone=%2B62'.$data_karyawan_filter->no_hp.'&text&app_absent=0>
                                <button class="btn btn-primary" data-original-title="Detail">
                                    <i class="fa fa-phone-square"></i>
                                </button>
                                </a>';

                            // $button .= '<a href=/profile_detail/'.$data->id_karyawan.' data-toggle="tooltip" class="btn btn-inverse-info btn-icon" >
                            //             <i class="mdi mdi-information"></i>
                            //             </a>';
                            return $button;
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        }

        return view('absensi/data_karyawan_filter', compact('data_karyawan_filter','zona'));

    }

    function tambah_data_karyawan(Request $request)
    {

        if($request->hasFile('foto')){
            $gambar_profil = $request->file('foto');
            $gambar = rand() . '.' . $gambar_profil->getClientOriginalExtension();
            $gambar_profil->move(public_path('assets/foto_profil'), $gambar);
        }

        else{
            $gambar = "default.png";
        }

        $karyawan                       = new Karyawan();
        $karyawan->nik                  = $request->nik;
        $karyawan->nama_lengkap         = $request->nama_lengkap;
        $karyawan->id_zona              = $request->id_zona;
        $karyawan->id_regu              = $request->id_regu;
        $karyawan->id_jabatan           = $request->id_jabatan;
        $karyawan->pt                   = $request->pt;
        $karyawan->no_kib               = $request->no_kib;
        $tgl                            = $request->tgl_lahir;
        $tgl_lahir                      = date("Y-m-d", strtotime($tgl));
        $karyawan->tgl_lahir            = $tgl_lahir;
        $karyawan->alamat               = $request->alamat;
        $karyawan->rtrw                 = $request->rtrw;
        $karyawan->desa                 = $request->desa;
        $karyawan->kecamatan            = $request->kecamatan;
        $karyawan->kabupaten            = $request->kabupaten;
        $karyawan->no_hp                = $request->no_hp;
        $karyawan->no_ktp               = $request->no_ktp;
        $karyawan->kompetensi_gada      = $request->kompetensi_gada;
        $karyawan->no_reg               = $request->no_reg;
        $karyawan->no_kta               = $request->no_kta;
        $karyawan->no_ijazah            = $request->no_ijazah;
        $tgl_jatuh_tempo                = $request->tgl_jatuhtempo_gada;
        $tgl_jatuhtempo_gada            = date("Y-m-d", strtotime($tgl_jatuh_tempo));
        $karyawan->tgl_jatuhtempo_gada  = $tgl_jatuhtempo_gada;
        $karyawan->status_aktif         = 1;
        $karyawan->save();

        $user                           = new User();
        $user->nik                      = $request->nik;
        $user->email                    = $request->email;
        $user->password                 = Hash::make($request->password);
        $user->id_level_user            = $request->id_level_user;
        $user->id_departemen            = $request->id_departemen;
        $user->foto                     = $gambar;
        $user->save();

        return redirect('data_karyawan')->with('success', 'Tambah Karyawan Berhasil');
    }

    public function tambah_karyawan_excel(){

        $dt_jabatan = DB::table('jabatans')->get();
        $dt_zona = DB::table('zonas')->get();
        $dt_regu = DB::table('regus')->get();
        $dt_level = DB::table('level_users')->get();
        $dt_departemen = DB::table('departemens')->get();

        return view('absensi/tambah_karyawan_excel',
            [
                'jabatan'       => $dt_jabatan,
                'zona'          => $dt_zona,
                'regu'          => $dt_regu,
                'level'         => $dt_level,
                'departemen'    => $dt_departemen
            ]);
    }

    public function kehadiran(){

        $hash = new Hashids();

        $hari_ini   = Carbon::now()->isoFormat('Y-MM-D');

        $tanggal    = Carbon::now()->isoFormat('D');
        $bulan      = Carbon::now()->isoFormat('M');
        $tahun      = Carbon::now()->isoFormat('Y');
        $id_regu    = auth()->user()->karyawan->id_regu;

        if($id_regu == '5'){
            $jadwal = JadwalShift::where('id_regu', $id_regu)
                    ->first();
        }
        else{
            $jadwal = JadwalShift::where('tanggal', $tanggal)
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->where('id_regu', $id_regu)
                    ->first();
        }

        $cek_data_ada  = DB::table('presensi_logs')->where('tanggal',$hari_ini)->where('nik', auth()->user()->nik)->first();

        return view('absensi/kehadiran', compact('hash'),
            [
                'jadwal'=>$jadwal,
                'cek_data_ada'=>$cek_data_ada,
            ]);
    }

    public function list_presensi(){

        $bulan = DB::table('bulans')->get();

        return view('absensi/list_presensi',
            [
                'data_bulan' => $bulan
            ]);
    }

    public function data_presensi_karyawan(Request $request){

        $tanggal_awal = $request->get("tanggal_awal");
        $tanggal_akhir = $request->get("tanggal_akhir");

        $id_bulan = $request->get("id_bulan");


        $data_karyawan = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.tgl_lahir','karyawans.alamat','karyawans.no_hp','karyawans.no_ktp','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto')
                ->where('pt','=',"FJM")
                ->orWhere('pt','=',"AJG")
                ->orderBy('id_regu','asc')
                ->get();

        if(request()->ajax()){
            return datatables()->of($data_karyawan)
                        ->addColumn('action', function($data_karyawan) use($tanggal_awal,$tanggal_akhir,$id_bulan){

                            $button =  '<a href="/detail_presensi_karyawan_all/?id_karyawan='.$data_karyawan->id_karyawan.'&id_bulan='.$id_bulan.'">
                                    <button class="btn btn-primary" data-original-title="Detail">
                                        <i class="fa fa-file-text"></i>
                                    </button>
                                </a>';
                            return $button;
                        })
                        ->rawColumns(['action'])
                        ->addIndexColumn()
                        ->make(true);
        }


        return view('absensi/data_presensi_karyawan', compact('data_karyawan','id_bulan'));
    }
    public function data_presensi_karyawan_all(Request $request){

        $id_bulan = $request->id_bulan;

        $dateFirst = $this->getBetweenDate($request->id_bulan, true);
        $dateEnd = $this->getBetweenDate($request->id_bulan, false);

        if($request->id_bulan == 1){
        // //Januari
        $tanggal_awal = "2020-12-26";
        $tanggal_akhir = "2021-01-25";
        }
        elseif($request->id_bulan == 2){
        // //Februari
        $tanggal_awal = "2021-01-26";
        $tanggal_akhir = "2021-02-25";
        }
        elseif($request->id_bulan == 3){
        // //Maret
        $tanggal_awal = "2021-02-26";
        $tanggal_akhir = "2021-03-25";
        }
        elseif($request->id_bulan == 4){
        // //April
        $tanggal_awal = "2021-03-26";
        $tanggal_akhir = "2021-04-25";
        }
        elseif($request->id_bulan == 5){
        // //Mei
        $tanggal_awal = "2021-04-26";
        $tanggal_akhir = "2021-05-25";
        }
        elseif($request->id_bulan == 6){
        // //Juni
        $tanggal_awal = "2021-05-26";
        $tanggal_akhir = "2021-06-25";
        }
        elseif($request->id_bulan == 7){
        // //Juli
        $tanggal_awal = "2021-06-26";
        $tanggal_akhir = "2021-07-25";
        }
        elseif($request->id_bulan == 8){
        // //Agustus
        $tanggal_awal = "2021-07-26";
        $tanggal_akhir = "2021-08-25";
        }
        elseif($request->id_bulan == 9){
        //September
        $tanggal_awal = "2021-08-26";
        $tanggal_akhir = "2021-09-25";
        }
        elseif($request->id_bulan == 10){
        // //Oktober
        $tanggal_awal = "2021-09-26";
        $tanggal_akhir = "2021-10-25";
        }
        elseif($request->id_bulan == 11){
        // //November
        $tanggal_awal = "2021-10-26";
        $tanggal_akhir = "2021-11-25";
        }
        elseif($request->id_bulan == 12){
        // //Desember
        $tanggal_awal = "2021-11-26";
        $tanggal_akhir = "2021-12-25";
        }

        return view('absensi/data_presensi_karyawan',
            [
                'tanggal_awal' => $tanggal_awal,
                'tanggal_akhir' => $tanggal_akhir,
                'id_bulan' => $id_bulan,
            ]);
    }

    public function detail_presensi_karyawan_all(Request $request){

        $dateFirst = $this->getBetweenDate($request->id_bulan, true);
        $dateEnd = $this->getBetweenDate($request->id_bulan, false);


        $dt_kar= DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.pt','karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.tgl_lahir','karyawans.alamat','karyawans.no_hp','karyawans.no_ktp','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto')
                ->where('karyawans.id_karyawan', $request->id_karyawan)
                ->get();

        $karyawan = Karyawan::where('id_karyawan',$request->id_karyawan)->first();
        $id_karyawan = $request->id_karyawan;

        $bulan = DB::table('bulans')->where('id_bulan',$request->id_bulan)->first();

        $pt = DB::table('karyawans')->where('id_karyawan', $request->id_karyawan)->first();

        $presensi = DB::table('presensi_logs')
                ->join('users','users.nik','=','presensi_logs.nik')
                ->join('karyawans','karyawans.nik','=','presensi_logs.nik')
                ->leftJoin('lemburs','lemburs.id_lembur','=','presensi_logs.id_lembur')
                ->leftJoin('lembur_khususes','lembur_khususes.id_lembur_khusus','=','presensi_logs.id_lembur_khusus')
                ->select('karyawans.pt','karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan',
                'karyawans.tgl_lahir','karyawans.alamat','karyawans.no_hp','karyawans.no_ktp','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto',
                'presensi_logs.id_presensi','presensi_logs.nik', 'presensi_logs.tanggal', 'presensi_logs.jadwal_kerja', 'presensi_logs.check_in','presensi_logs.check_out', 'presensi_logs.detail','presensi_logs.id_lembur','presensi_logs.id_lembur_khusus','presensi_logs.id_absensi',
                'lemburs.total_jam_lembur','lembur_khususes.total_jam_lembur_khusus','lemburs.detail_lembur','lembur_khususes.detail_lembur_khusus')
                ->where('presensi_logs.nik', $karyawan->nik)
                ->whereRaw('presensi_logs.tanggal >= ? and presensi_logs.tanggal <= ?',[$dateFirst,$dateEnd])
                ->orderBy('presensi_logs.tanggal', 'asc')
                ->get();

        $datetime1 = new DateTime($dateFirst);
        $datetime2 = new DateTime($dateEnd);
        $interval = $datetime1->diff($datetime2);
        $total_hari = $interval->format('%a');

        $cuti = DB::table('absensi_logs')
                ->where('nik', $karyawan->nik)
                ->where('tipe_absen','=','Cuti')
                ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$dateFirst,$dateEnd])
                ->count();
        $dispensasi = DB::table('absensi_logs')
                ->where('nik', $karyawan->nik)
                ->where('tipe_absen','=','Dispensasi')
                ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$dateFirst,$dateEnd])
                ->count();
        $sakit = DB::table('absensi_logs')
                ->where('nik', $karyawan->nik)
                ->where('tipe_absen','=','Sakit')
                ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$dateFirst,$dateEnd])
                ->count();
        $ijin = DB::table('absensi_logs')
                ->where('nik', $karyawan->nik)
                ->where('tipe_absen','=','Ijin')
                ->where('terbit','=',1)
                ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$dateFirst,$dateEnd])
                ->count();

        $off = DB::table('presensi_logs')
                ->where('nik', $karyawan->nik)
                ->where('jadwal_kerja','=','OFF')
                ->whereRaw('tanggal >= ? and tanggal <= ?',[$dateFirst,$dateEnd])
                ->count();

        $total_absen = DB::table('presensi_logs')
                ->where('nik', $karyawan->nik)
                ->whereRaw('tanggal >= ? and tanggal <= ?',[$dateFirst,$dateEnd])
                ->count('detail');

        $hadir = DB::table('presensi_logs')
                ->where('nik', $karyawan->nik)
                ->whereRaw('tanggal >= ? and tanggal <= ?',[$dateFirst,$dateEnd])
                ->count('lat');

        $mangkir = ($total_hari+1)-($off+$total_absen+$hadir);

        $total_spl = DB::table('lemburs')
                ->where('nik', $karyawan->nik)
                ->where('terbit','=',1)
                ->whereRaw('tgl_lembur >= ? and tgl_lembur <= ?',[$dateFirst,$dateEnd])
                ->sum('total_jam_lembur');

        $total_lk = DB::table('lembur_khususes')
                ->where('nik', $karyawan->nik)
                ->where('terbit','=',1)
                ->whereRaw('tgl_lembur_khusus >= ? and tgl_lembur_khusus <= ?',[$dateFirst,$dateEnd])
                ->sum('total_jam_lembur_khusus');


        return view('absensi/detail_presensi',
            [
                'data_absen' => $presensi,
                'bulan' => $bulan,
                'cuti' => $cuti,
                'dispensasi' => $dispensasi,
                'sakit' => $sakit,
                'ijin' => $ijin,
                'mangkir' => $mangkir,
                'hadir' => $hadir,
                'spl' => $total_spl,
                'lk' => $total_lk,
                'data_karyawan' => $dt_kar,
                'date_first' => $dateFirst,
                'date_end' => $dateEnd,
                'pt' => $pt,
            ]);
    }

    public function detail_presensi(Request $request){
        
        $dateFirst = $this->getBetweenDate($request->id_bulan, true);
        $dateEnd = $this->getBetweenDate($request->id_bulan, false);
        
        $bulan = DB::table('bulans')->where('id_bulan',$request->id_bulan)->first();
        
        $presensi = DB::table('presensi_logs')
        ->join('users','users.nik','=','presensi_logs.nik')
        ->join('karyawans','karyawans.nik','=','presensi_logs.nik')
        ->leftJoin('lemburs','lemburs.id_lembur','=','presensi_logs.id_lembur')
        ->leftJoin('lembur_khususes','lembur_khususes.id_lembur_khusus','=','presensi_logs.id_lembur_khusus')
        ->select('karyawans.pt','karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan',
        'karyawans.tgl_lahir','karyawans.alamat','karyawans.no_hp','karyawans.no_ktp','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto',
        'presensi_logs.id_presensi','presensi_logs.nik', 'presensi_logs.tanggal', 'presensi_logs.jadwal_kerja', 'presensi_logs.check_in','presensi_logs.check_out', 'presensi_logs.detail','presensi_logs.id_lembur','presensi_logs.id_lembur_khusus','presensi_logs.id_absensi',
        'lemburs.total_jam_lembur','lembur_khususes.total_jam_lembur_khusus','lemburs.detail_lembur','lembur_khususes.detail_lembur_khusus')
        ->where('presensi_logs.nik', auth()->user()->karyawan->nik)
        ->whereRaw('presensi_logs.tanggal >= ? and presensi_logs.tanggal <= ?',[$dateFirst,$dateEnd])
        ->orderBy('presensi_logs.tanggal', 'asc')
        ->get();
        
        $dt_kar= DB::table('karyawans')
        ->join('users', 'users.nik' ,'=', 'karyawans.nik')
        ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
        ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
        ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
        ->select('karyawans.pt','karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
        'karyawans.tgl_lahir','karyawans.alamat','karyawans.no_hp','karyawans.no_ktp','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto')
        ->where('karyawans.nik', auth()->user()->karyawan->nik)
        ->get();
        
        
        $pt = DB::table('karyawans')->where('nik', auth()->user()->karyawan->nik)->first();
       
        $datetime1 = new DateTime($dateFirst);
        $datetime2 = new DateTime($dateEnd);
        
        $interval = $datetime1->diff($datetime2);
        $total_hari = $interval->format('%a');
        
        $cuti = DB::table('absensi_logs')
                ->where('nik', auth()->user()->karyawan->nik)
                ->where('tipe_absen','=','Cuti')
                ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$dateFirst,$dateEnd])
                ->count();
        $dispensasi = DB::table('absensi_logs')
                ->where('nik', auth()->user()->karyawan->nik)
                ->where('tipe_absen','=','Dispensasi')
                ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$dateFirst,$dateEnd])
                ->count();
        $sakit = DB::table('absensi_logs')
                ->where('nik', auth()->user()->karyawan->nik)
                ->where('tipe_absen','=','Sakit')
                ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$dateFirst,$dateEnd])
                ->count();
        $ijin = DB::table('absensi_logs')
                ->where('nik', auth()->user()->karyawan->nik)
                ->where('tipe_absen','=','Ijin')
                ->where('terbit','=',1)
                ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$dateFirst,$dateEnd])
                ->count();

        $off = DB::table('presensi_logs')
                ->where('nik', auth()->user()->karyawan->nik)
                ->where('jadwal_kerja','=','OFF')
                ->whereRaw('tanggal >= ? and tanggal <= ?',[$dateFirst,$dateEnd])
                ->count();

        $total_absen = DB::table('presensi_logs')
                ->where('nik', auth()->user()->karyawan->nik)
                ->whereRaw('tanggal >= ? and tanggal <= ?',[$dateFirst,$dateEnd])
                ->count('detail');

        $hadir = DB::table('presensi_logs')
                ->where('nik', auth()->user()->karyawan->nik)
                ->whereRaw('tanggal >= ? and tanggal <= ?',[$dateFirst,$dateEnd])
                ->count('lat');

        $mangkir = ($total_hari+1)-($off+$total_absen+$hadir);

        $total_spl = DB::table('lemburs')
                ->where('nik', auth()->user()->karyawan->nik)
                ->where('terbit','=',1)
                ->whereRaw('tgl_lembur >= ? and tgl_lembur <= ?',[$dateFirst,$dateEnd])
                ->sum('total_jam_lembur');

        $total_lk = DB::table('lembur_khususes')
                ->where('nik', auth()->user()->karyawan->nik)
                ->where('terbit','=',1)
                ->whereRaw('tgl_lembur_khusus >= ? and tgl_lembur_khusus <= ?',[$dateFirst,$dateEnd])
                ->sum('total_jam_lembur_khusus');

                // dd($request->id_bulan);
        return view('absensi/detail_presensi',
            [
                'data_absen' => $presensi,
                'bulan' => $bulan,
                'cuti' => $cuti,
                'dispensasi' => $dispensasi,
                'sakit' => $sakit,
                'ijin' => $ijin,
                'mangkir' => $mangkir,
                'hadir' => $hadir,
                'spl' => $total_spl,
                'lk' => $total_lk,
                'pt' => $pt,
                'data_karyawan' => $dt_kar,
                'date_first' => $dateFirst,
                'date_end' => $dateEnd,
            ]);
    }

    public function webview_detail_presensi(Request $request){
        
        $dateFirst = $this->getBetweenDate($request->id_bulan, true);
        $dateEnd = $this->getBetweenDate($request->id_bulan, false);
        $nik_karyawan = $request->nik;
        // dd(auth()->user()->karyawan->nik);
        $bulan = DB::table('bulans')->where('id_bulan',$request->id_bulan)->first();
        
        $presensi = DB::table('presensi_logs')
        ->join('users','users.nik','=','presensi_logs.nik')
        ->join('karyawans','karyawans.nik','=','presensi_logs.nik')
        ->leftJoin('lemburs','lemburs.id_lembur','=','presensi_logs.id_lembur')
        ->leftJoin('lembur_khususes','lembur_khususes.id_lembur_khusus','=','presensi_logs.id_lembur_khusus')
        ->select('karyawans.pt','karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan',
        'karyawans.tgl_lahir','karyawans.alamat','karyawans.no_hp','karyawans.no_ktp','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto',
        'presensi_logs.id_presensi','presensi_logs.nik', 'presensi_logs.tanggal', 'presensi_logs.jadwal_kerja', 'presensi_logs.check_in','presensi_logs.check_out', 'presensi_logs.detail','presensi_logs.id_lembur','presensi_logs.id_lembur_khusus','presensi_logs.id_absensi',
        'lemburs.total_jam_lembur','lembur_khususes.total_jam_lembur_khusus','lemburs.detail_lembur','lembur_khususes.detail_lembur_khusus')
        ->where('presensi_logs.nik', $nik_karyawan)
        ->whereRaw('presensi_logs.tanggal >= ? and presensi_logs.tanggal <= ?',[$dateFirst,$dateEnd])
        ->orderBy('presensi_logs.tanggal', 'asc')
        ->get();
        
        $dt_kar= DB::table('karyawans')
        ->join('users', 'users.nik' ,'=', 'karyawans.nik')
        ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
        ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
        ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
        ->select('karyawans.pt','karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
        'karyawans.tgl_lahir','karyawans.alamat','karyawans.no_hp','karyawans.no_ktp','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto')
        ->where('karyawans.nik', $nik_karyawan)
        ->get();
        
        
        $pt = DB::table('karyawans')->where('nik', $nik_karyawan)->first();
       
        $datetime1 = new DateTime($dateFirst);
        $datetime2 = new DateTime($dateEnd);
        
        $interval = $datetime1->diff($datetime2);
        $total_hari = $interval->format('%a');
        
        $cuti = DB::table('absensi_logs')
                ->where('nik', $nik_karyawan)
                ->where('tipe_absen','=','Cuti')
                ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$dateFirst,$dateEnd])
                ->count();
        $dispensasi = DB::table('absensi_logs')
                ->where('nik', $nik_karyawan)
                ->where('tipe_absen','=','Dispensasi')
                ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$dateFirst,$dateEnd])
                ->count();
        $sakit = DB::table('absensi_logs')
                ->where('nik', $nik_karyawan)
                ->where('tipe_absen','=','Sakit')
                ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$dateFirst,$dateEnd])
                ->count();
        $ijin = DB::table('absensi_logs')
                ->where('nik', $nik_karyawan)
                ->where('tipe_absen','=','Ijin')
                ->where('terbit','=',1)
                ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$dateFirst,$dateEnd])
                ->count();

        $off = DB::table('presensi_logs')
                ->where('nik', $nik_karyawan)
                ->where('jadwal_kerja','=','OFF')
                ->whereRaw('tanggal >= ? and tanggal <= ?',[$dateFirst,$dateEnd])
                ->count();

        $total_absen = DB::table('presensi_logs')
                ->where('nik', $nik_karyawan)
                ->whereRaw('tanggal >= ? and tanggal <= ?',[$dateFirst,$dateEnd])
                ->count('detail');

        $hadir = DB::table('presensi_logs')
                ->where('nik', $nik_karyawan)
                ->whereRaw('tanggal >= ? and tanggal <= ?',[$dateFirst,$dateEnd])
                ->count('lat');

        $mangkir = ($total_hari+1)-($off+$total_absen+$hadir);

        $total_spl = DB::table('lemburs')
                ->where('nik', $nik_karyawan)
                ->where('terbit','=',1)
                ->whereRaw('tgl_lembur >= ? and tgl_lembur <= ?',[$dateFirst,$dateEnd])
                ->sum('total_jam_lembur');

        $total_lk = DB::table('lembur_khususes')
                ->where('nik', $nik_karyawan)
                ->where('terbit','=',1)
                ->whereRaw('tgl_lembur_khusus >= ? and tgl_lembur_khusus <= ?',[$dateFirst,$dateEnd])
                ->sum('total_jam_lembur_khusus');

                // dd($request->id_bulan);
        return view('webview/detail_presensi',
            [
                'data_absen' => $presensi,
                'bulan' => $bulan,
                'cuti' => $cuti,
                'dispensasi' => $dispensasi,
                'sakit' => $sakit,
                'ijin' => $ijin,
                'mangkir' => $mangkir,
                'hadir' => $hadir,
                'spl' => $total_spl,
                'lk' => $total_lk,
                'pt' => $pt,
                'data_karyawan' => $dt_kar,
                'date_first' => $dateFirst,
                'date_end' => $dateEnd,
            ]);
    }

    public function list_rekap_zona(){

        $bulan = DB::table('bulans')->get();

        $zona = DB::table('zonas')->get();

        return view('absensi/list_rekap_zona',
            [
                'data_zona' => $zona,
                'data_bulan' => $bulan
            ]);
    }

    private function getBetweenDate($id_bulan, $is_first){

        if($is_first){
            if($id_bulan == 1)
            $fixed_bulan = 12;
            else
            $fixed_bulan = str_pad($id_bulan-1, 2, '0', STR_PAD_LEFT);
        }else{
            $fixed_bulan = str_pad($id_bulan, 2, '0', STR_PAD_LEFT);
        }

        $tahun = $id_bulan == 1 && $is_first ? date('Y', strtotime('-1 year')) : date('Y');
        $dateFirst = $tahun.'-'.$fixed_bulan.'-'.($is_first ? '26' : '25');

        return $dateFirst;
    }

    public function list_rekap_zona_filter(Request $request){

        $zona_pilih = $request->id_zona;

        $dateFirst = $this->getBetweenDate($request->id_bulan, true);
        $dateEnd = $this->getBetweenDate($request->id_bulan, false);

        $data_karyawan = Karyawan::select('nik', 'nama_lengkap', 'id_regu')->with([
                        'user:nik,email,foto',
                        'regu:id_regu,nama_regu',
                        'zona:id_zona,nama_zona',
                    ])
                    ->withCount([
                        'presensilog as h' => function($q) use ($dateFirst, $dateEnd){
                            $q->whereNotNull('lat')->whereBetween('tanggal', [$dateFirst, $dateEnd]);
                        },
                        'presensilog as i' => function($q) use ($dateFirst, $dateEnd){
                            $q->where('jadwal_kerja', 'Ijin')->whereBetween('tanggal', [$dateFirst, $dateEnd]);
                        },
                        'presensilog as s' => function($q) use ($dateFirst, $dateEnd){
                            $q->where('jadwal_kerja', 'Sakit')->whereBetween('tanggal', [$dateFirst, $dateEnd]);
                        },
                        'presensilog as c' => function($q) use ($dateFirst, $dateEnd){
                            $q->where('jadwal_kerja', 'Cuti')->whereBetween('tanggal', [$dateFirst, $dateEnd]);
                        },
                        'presensilog as d' => function($q) use ($dateFirst, $dateEnd){
                            $q->where('jadwal_kerja', 'Dispensasi')->whereBetween('tanggal', [$dateFirst, $dateEnd]);
                        },

                    ])
                    ->where('karyawans.id_zona', $zona_pilih)->where(function($q){
                        $q->orWhere('pt','=','AJG')->orWhere('pt','=','FJM');
                    })
                    ->orderBy('karyawans.id_zona','asc')->orderBy('karyawans.id_regu', 'asc')
                    ->get();


        $dayInMonth = cal_days_in_month(CAL_GREGORIAN, $request->id_bulan,date('Y'));

        $data_karyawan->map(function($q) use ($dayInMonth, $dateFirst, $dateEnd){
            // $q['a'] = 22222;
            $q['a'] = $dayInMonth - PresensiLog::where('nik', $q->nik)->whereBetween('tanggal', [$dateFirst, $dateEnd])->count();
            $q['spl'] = Lembur::where('nik', $q->nik)->where('terbit','=',1)->whereBetween('tgl_lembur', [$dateFirst, $dateEnd])->sum('total_jam_lembur');
            $q['lk'] = LemburKhusus::where('nik', $q->nik)->where('terbit','=',1)->whereBetween('tgl_lembur_khusus', [$dateFirst, $dateEnd])->sum('total_jam_lembur_khusus');

            $tgl_th = [];
            for($i = 0; $i <= $dayInMonth; $i++){
                $checkDate = date('Y-m-d',strtotime($dateFirst . "+$i days"));
                $isFound = PresensiLog::where('nik', $q->nik)->whereDate('tanggal', $checkDate)->first();

                if(is_null($isFound))
                array_push($tgl_th, date('d', strtotime($checkDate)));
            }
            $q['tgl_th'] = $tgl_th;

            return $q;
        });

        $bulan = DB::table('bulans')->where('id_bulan',$request->id_bulan)->first();

        return view('absensi/list_rekap_zona_filter',
            [
                'data_karyawan' => $data_karyawan,
                'bulan' => $bulan,
                'dateFirst' => $dateFirst,
                'dateEnd' => $dateEnd
            ]);


        // $data_karyawan = DB::table('karyawans')
        //         ->leftJoin('regus',function($join){
        //             $join->on('karyawans.id_regu','=','regus.id_regu');
        //         })
        //         ->leftJoin('presensi_logs',function($join) use($tanggal_akhir,$tanggal_awal){
        //             $join->on('karyawans.nik','=','presensi_logs.nik')
        //             ->whereRaw('tanggal >= ? and tanggal <= ?',[$tanggal_awal,$tanggal_akhir]);
        //         })
        //         ->leftJoin('absensi_logs',function($join) use($tanggal_akhir,$tanggal_awal){
        //             $join->on('karyawans.nik','=','absensi_logs.nik')
        //             ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$tanggal_awal,$tanggal_akhir]);
        //         })
        //         ->leftJoin('lemburs',function($join) use($tanggal_akhir,$tanggal_awal){
        //             $join->on('karyawans.nik','=','lemburs.nik')
        //             ->whereRaw('tgl_lembur >= ? and tgl_lembur <= ?',[$tanggal_awal,$tanggal_akhir]);
        //         })
        //         ->leftJoin('lembur_khususes',function($join) use($tanggal_akhir,$tanggal_awal){
        //             $join->on('karyawans.nik','=','lembur_khususes.nik')
        //             ->whereRaw('tgl_lembur_khusus >= ? and tgl_lembur_khusus <= ?',[$tanggal_awal,$tanggal_akhir]);
        //         })
        //         ->select(
        //             'karyawans.nik',
        //             'karyawans.nama_lengkap',
        //             'regus.nama_regu',
        //             DB::raw('count(presensi_logs.lat) as tot_hadir'),
        //             DB::raw('sum(case when tipe_absen = "Cuti" then 1 else 0 end) as tot_cuti'),
        //             DB::raw('sum(case when tipe_absen = "Ijin" then 1 else 0 end) as tot_ijin'),
        //             DB::raw('sum(case when tipe_absen = "Dispensasi" then 1 else 0 end) as tot_dispensasi'),
        //             DB::raw('sum(case when tipe_absen = "Sakit" then 1 else 0 end) as tot_sakit'),
        //             DB::raw('SUM(total_jam_lembur) as tot_spl'),
        //             DB::raw('SUM(total_jam_lembur_khusus) as tot_lk'),
        //         )
        //         ->where('karyawans.id_zona', $zona_pilih)->where(function($q){
        //                 $q->orWhere('pt','=','AJG')->orWhere('pt','=','FJM');
        //             })
        //         ->orderBy('karyawans.id_zona','asc')->orderBy('karyawans.id_regu', 'asc')
        //         ->groupBy('karyawans.nik')
        //         ->get();

        // $bulan = DB::table('bulans')->where('id_bulan',$request->id_bulan)->first();

        // $datetime1 = new DateTime($tanggal_awal);
        // $datetime2 = new DateTime($tanggal_akhir);
        // $interval = $datetime1->diff($datetime2);
        // $total_hari = $interval->format('%a');

        // $total_absen = DB::table('presensi_logs')
        //         ->where('nik', auth()->user()->karyawan->nik)
        //         ->whereRaw('tanggal>= ? and tanggal <= ?',[$tanggal_awal,$tanggal_akhir])
        //         ->count('detail');

        // $off = DB::table('presensi_logs')
        //         ->where('jadwal_kerja','=','OFF')
        //         ->whereRaw('tanggal >= ? and tanggal <= ?',[$tanggal_awal,$tanggal_akhir])
        //         ->groupBy('nik')
        //         ->get();

        // $mangkir = ($total_hari+1)-($off+$total_absen+$total_hadir);

        // $total_hadir = DB::table('presensi_logs')
        //                 ->select('nik',DB::raw('count(lat) as tot_hadir'))
        //                 ->whereRaw('tanggal >= ? and tanggal <= ?',[$tanggal_awal,$tanggal_akhir])
        //                 ->groupBy('nik')
        //                 ->get();

        // $total_cuti = DB::table('absensi_logs')
        //                 ->select('nik',DB::raw('sum(case when tipe_absen = "Cuti" then 1 else 0 end) as tot_cuti'))
        //                 ->where('terbit',1)
        //                 ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$tanggal_awal,$tanggal_akhir])
        //                 ->groupBy('nik')
        //                 ->get();
        // $total_ijin = DB::table('absensi_logs')
        //                 ->select('nik',DB::raw('sum(case when tipe_absen = "Ijin" then 1 else 0 end) as tot_ijin'))
        //                 ->where('terbit',1)
        //                 ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$tanggal_awal,$tanggal_akhir])
        //                 ->groupBy('nik')
        //                 ->get();
        // $total_dispensasi = DB::table('absensi_logs')
        //                 ->select('nik',DB::raw('sum(case when tipe_absen = "Dispensasi" then 1 else 0 end) as tot_dispensasi'))
        //                 ->where('terbit',1)
        //                 ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$tanggal_awal,$tanggal_akhir])
        //                 ->groupBy('nik')
        //                 ->get();
        // $total_sakit = DB::table('absensi_logs')
        //                 ->select('nik',DB::raw('sum(case when tipe_absen = "Sakit" then 1 else 0 end) as tot_sakit'))
        //                 ->where('terbit',1)
        //                 ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$tanggal_awal,$tanggal_akhir])
        //                 ->groupBy('nik')
        //                 ->get();
        // $total_spl = DB::table('lemburs')
        //                 ->select('nik',DB::raw('SUM(total_jam_lembur) as tot_spl'))
        //                 ->where('terbit','=',1)
        //                 ->whereRaw('tgl_lembur >= ? and tgl_lembur <= ?',[$tanggal_awal,$tanggal_akhir])
        //                 ->groupBy('nik')
        //                 ->get();
        // $total_lk = DB::table('lembur_khususes')
        //                 ->select('nik',DB::raw('SUM(total_jam_lembur_khusus) as tot_lk'))
        //                 ->where('terbit','=',1)
        //                 ->whereRaw('tgl_lembur_khusus >= ? and tgl_lembur_khusus <= ?',[$tanggal_awal,$tanggal_akhir])
        //                 ->groupBy('nik')
        //                 ->get();

        // return view('absensi/list_rekap_zona_filter',
        //     [
        //         'data_karyawan' => $data_karyawan,
        //         'bulan' => $bulan,
        //         'total_hadir' => $total_hadir,
        //         'total_cuti' => $total_cuti,
        //         'total_ijin' => $total_ijin,
        //         'total_dispensasi' => $total_dispensasi,
        //         'total_sakit' => $total_sakit,
        //         'total_spl' => $total_spl,
        //         'total_lk' => $total_lk,
        //     ]);
    }


    public function get_jadwal_tukar(Request $request)
    {
        $nik = auth()->user()->nik;
        $tanggal_tukar = $request->tanggal_tukar;

        $tgl_explode = explode('/',$tanggal_tukar);

        $tanggal = $tgl_explode[0];
        $bulan = $tgl_explode[1];
        $tahun = $tgl_explode[2];

        $karyawan = DB::table('karyawans')->where('nik','=',$nik)->first();

        $jadwal_tukar = DB::table('jadwal_shifts')
                    ->where('tanggal','=',$tanggal)
                    ->where('bulan','=',$bulan)
                    ->where('tahun','=',$tahun)
                    ->where('id_regu','=',$karyawan->id_regu)
                    ->first();


        if($jadwal_tukar != null && $jadwal_tukar->action != "OFF"){
            //get constraint tukar shift
            $shift_today = $jadwal_tukar->action;

            $can_swap_to = DB::table('tukar_shift_ref')
                                ->where('asal_shift',$shift_today)
                                ->get();

            $action_can_swap = array_column($can_swap_to->toArray(), 'tujuan_shift'); //result ex : ['S','M']
            $is_have_overlap_day = in_array('1',array_column($can_swap_to->toArray(), 'overlap_day'));

            $list_jadwal_shift_can_swap = DB::table('jadwal_shifts');

            $next_day = date('Y-m-d',strtotime($tanggal_tukar.' +1 day'));
            $tgl_next = date('d',strtotime($next_day));
            $bulan_next = date('m',strtotime($next_day));
            $tahun_next = date('Y',strtotime($next_day));

            $whereString = [];

            foreach($can_swap_to as $ref_tukar){
                if($ref_tukar->overlap_day){
                    $whereString[] = "(tanggal = $tgl_next and bulan = $bulan_next and tahun = $tahun_next and action = '$ref_tukar->tujuan_shift')";
                }else{
                    $whereString[] = "(tanggal = $tanggal and bulan = $bulan and tahun = $tahun and action = '$ref_tukar->tujuan_shift')";
                }
            }

            $list_jadwal_shift_can_swap->whereRaw(implode(" OR ",$whereString));

            $result = $list_jadwal_shift_can_swap->get();

            $regu_can_swap = array_column($result->toArray(), 'id_regu');

            $karyawan_can_swap = DB::table('karyawans')
                                    ->where('id_zona',$karyawan->id_zona)
                                    ->whereIn('id_regu',$regu_can_swap)->get();

            return response()->json([
                'source' => $jadwal_tukar,
                'destination' => $result,
                'karyawan_can_swap' => $karyawan_can_swap
            ]);

        }

        return response()->json([
            'source' => null,
            'destination' => null,
            'karyawan_can_swap' => null
        ]);
    }

    public function data_autofield(Request $request, $id)
    {
        $response = Karyawan::with([
                    'user:id_user,nik,email,foto',
                    'regu:id_regu,nama_regu',
                    'zona:id_zona,nama_zona',
                    'jabatan:id_jabatan,nama_jabatan,direct_jab_atasan,direct_jab_atasan_2',
                    'jabatan.atasan_1.user'
                    ])
                    ->with('jabatan.atasan_1','jabatan.atasan_2')
                    ->where('id_karyawan', $id)
                    ->first();


        $tanggal    = Carbon::now()->isoFormat('D');
        $bulan      = Carbon::now()->isoFormat('M');
        $tahun      = Carbon::now()->isoFormat('Y');
        $id_regu    = auth()->user()->karyawan->id_regu;


        if($id_regu == '5'){
            $jadwal = JadwalShift::where('id_regu', $id_regu)
                    ->first();
        }
        else{
            $jadwal = JadwalShift::where('tanggal', $tanggal)
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->where('id_regu', $id_regu)
                    ->first();
        }

        return response()->json([
            'karyawan' => $response,
            'jadwal' => $jadwal
        ]);

        // return [
        //     'karyawan' => $response->toJson(),
        //     'jadwal' => $jadwal->toJson()
        // ];
    }

    public function form_masuk(Request $request, $nik)
    {
        $nik = auth()->user()->nik;

        if(auth()->user()->id_level_user == 1){
            $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->distinct()
                ->orderBy('karyawans.id_karyawan', 'asc')
                ->get();
        }
        elseif(auth()->user()->id_level_user == 12){
            $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->distinct()
                ->orderBy('karyawans.id_karyawan', 'asc')
                ->get();
        }
        else{
            $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->distinct()
                ->where('karyawans.nik', $nik)
                ->orderBy('karyawans.id_karyawan', 'asc')
                ->get();
        }

        $tanggal    = Carbon::now()->isoFormat('D');
        $bulan      = Carbon::now()->isoFormat('M');
        $tahun      = Carbon::now()->isoFormat('Y');
        $id_regu    = auth()->user()->karyawan->id_regu;

        if($id_regu == '5'){
            $jadwal = JadwalShift::where('id_regu', $id_regu)
                    ->first();
        }
        else{
            $jadwal = JadwalShift::where('tanggal', $tanggal)
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->where('id_regu', $id_regu)
                    ->first();
        }

        /* $ip = $request->ip(); Dynamic IP address */
        $ip = '180.253.165.229';  /*Static IP address */
        $currentUserInfo = Location::get($ip);


        return view('absensi/form_masuk',
        [
            'data_kar' => $dt_kar,
            'currentuserinfo' => $currentUserInfo,
            'jadwal' => $jadwal
        ]
    );
    }

function check_in(Request $request)
    {
        // $waktuabsen = date('H:i:s l jS F Y');
        // $now=date('H.i');

        $datenow = Carbon::now();
        $nik = $request->niknik;
        $nama_lengkap = $request->nama_lengkap;
        $checklist_presensi = DB::table('presensi_logs')->where('nik', $nik)->whereDate('tanggal',date('Y-m-d'))->first();

        $tanggal    = Carbon::now()->isoFormat('D');
        $bulan      = Carbon::now()->isoFormat('M');
        $tahun      = Carbon::now()->isoFormat('Y');
        $id_regu    = auth()->user()->karyawan->id_regu;

        $hari    = Carbon::now()->isoFormat('dddd');

        $jam = Carbon::now()->isoFormat('HH:mm');

        if($id_regu == 5){
            $jadwal = JadwalShift::where('id_regu', $id_regu)->first();
        }
        else{
            $jadwal = JadwalShift::where('tanggal', $tanggal)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->where('id_regu', $id_regu)
                ->first();
        }

        $jam_skrg = date('H:i:s');
        $jdwl_kerja = $request->jam_masuk;

        if (is_null($checklist_presensi)) {

            if($jadwal->action == "ND"){
                $absensi                        = new PresensiLog();
                $absensi->nik                   = $nik;
                $absensi->tanggal               = $datenow;
                $absensi->jadwal_kerja          = $request->jadwal_kerja;
                $absensi->lat                   = $request->lat;
                $absensi->lng                   = $request->lng;
                $absensi->id_zona               = $request->id_zona;
                $absensi->id_regu               = $request->id_regu;
                $absensi->id_jabatan            = $request->id_jabatan;
                $absensi->check_in              = $datenow;
                $absensi->check_out             = "";
                $absensi->status                = "on_duty";
                $absensi->save();

                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Presensi";
                $notifikasi->judul_notifikasi    = "Presensi Hadir Karyawan";
                $notifikasi->isi_notifikasi      = "Karyawan ". $nama_lengkap. " telah check in pada pukul ". $jam;
                $notifikasi->user_id_penerima    = $request->user_id_penerima;
                $notifikasi->status              = 0;
                $notifikasi->save();

                alert()->success('Absen berhasil, harap diperhatikan checkout dijam yang sesuai','Terima Kasih');
                return redirect('kehadiran')->with('success', 'Absen Masuk Berhasil');
            }
            elseif ($jadwal->action == "OFF") {
                $absensi                        = new PresensiLog();
                $absensi->nik                   = $nik;
                $absensi->tanggal               = $datenow;
                $absensi->jadwal_kerja          = "OFF";
                $absensi->lat                   = null;
                $absensi->lng                   = null;
                $absensi->id_zona               = $request->id_zona;
                $absensi->id_regu               = $request->id_regu;
                $absensi->id_jabatan            = $request->id_jabatan;
                $absensi->check_in              = null;
                $absensi->check_out             = null;
                $absensi->status                = "off_duty";
                $absensi->save();

                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Presensi";
                $notifikasi->judul_notifikasi    = "Presensi Hadir Jadwal OFF";
                $notifikasi->isi_notifikasi      = "Karyawan ". $nama_lengkap. " telah check in dengan jadwal OFF pada Pukul ". $datenow->toTimeString();
                $notifikasi->user_id_penerima    = $request->user_id_penerima;
                $notifikasi->status              = 0;
                $notifikasi->save();

                alert()->success('Absen di jam OFF Berhasil','Terima Kasih');

                return redirect('kehadiran')->with('off', 'Absen Masuk Berhasil');
            }

            elseif($jam_skrg >= $jdwl_kerja){
                $absensi                        = new PresensiLog();
                $absensi->nik                   = $nik;
                $absensi->tanggal               = $datenow;
                $absensi->jadwal_kerja          = $request->jadwal_kerja;
                $absensi->lat                   = $request->lat;
                $absensi->lng                   = $request->lng;
                $absensi->id_zona               = $request->id_zona;
                $absensi->id_regu               = $request->id_regu;
                $absensi->id_jabatan            = $request->id_jabatan;
                $absensi->check_in              = $datenow;
                $absensi->check_out             = "";
                $absensi->status                = "on_duty";
                $absensi->save();

                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Presensi";
                $notifikasi->judul_notifikasi    = "Presensi Hadir Karyawan";
                $notifikasi->isi_notifikasi      = "Karyawan ". $nama_lengkap. " telah check in pada pukul ". $jam;
                $notifikasi->user_id_penerima    = $request->user_id_penerima;
                $notifikasi->status              = 0;
                $notifikasi->save();

                alert()->success('Absen berhasil, harap diperhatikan checkout dijam yang sesuai','Terima Kasih');
                return redirect('kehadiran')->with('success', 'Absen Masuk Berhasil');
            }

            elseif ($hari == "Sabtu") {
                $absensi                        = new PresensiLog();
                $absensi->nik                   = $nik;
                $absensi->tanggal               = $datenow;
                $absensi->jadwal_kerja          = "OFF";
                $absensi->lat                   = null;
                $absensi->lng                   = null;
                $absensi->id_zona               = $request->id_zona;
                $absensi->id_regu               = $request->id_regu;
                $absensi->id_jabatan            = $request->id_jabatan;
                $absensi->check_in              = null;
                $absensi->check_out             = null;
                $absensi->status                = "off_duty";
                $absensi->save();

                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Presensi";
                $notifikasi->judul_notifikasi    = "Presensi Hadir Jadwal OFF";
                $notifikasi->isi_notifikasi      = "Karyawan ". $nama_lengkap. " telah check in dengan jadwal OFF pada Pukul ". $datenow->toTimeString();
                $notifikasi->user_id_penerima    = $request->user_id_penerima;
                $notifikasi->status              = 0;
                $notifikasi->save();

                alert()->success('Absen di jam OFF Berhasil','Terima Kasih');

                return redirect('kehadiran')->with('off', 'Absen Masuk Berhasil');
            }

            elseif ($hari == "Minggu") {
                $absensi                        = new PresensiLog();
                $absensi->nik                    = $nik;
                $absensi->tanggal               = $datenow;
                $absensi->jadwal_kerja          = "OFF";
                $absensi->lat                   = null;
                $absensi->lng                   = null;
                $absensi->id_zona               = $request->id_zona;
                $absensi->id_regu               = $request->id_regu;
                $absensi->id_jabatan            = $request->id_jabatan;
                $absensi->check_in              = null;
                $absensi->check_out             = null;
                $absensi->status                = "off_duty";
                $absensi->save();

                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Presensi";
                $notifikasi->judul_notifikasi    = "Presensi Hadir Jadwal OFF";
                $notifikasi->isi_notifikasi      = "Karyawan ". $nama_lengkap. " telah check in dengan jadwal OFF pada Pukul ". $datenow->toTimeString();
                $notifikasi->user_id_penerima    = $request->user_id_penerima;
                $notifikasi->status              = 0;
                $notifikasi->save();

                alert()->success('Absen di jam OFF Berhasil','Terima Kasih');

                return redirect('kehadiran')->with('off', 'Absen Masuk Berhasil');
            }




            else{
                Alert::error('Tidak sesuai jadwal jam kerja','Silahkan absen pada waktunya');
                return redirect('kehadiran');
            }
        }

        else{
        $getinnow = DB::table('presensi_logs')->where('nik', $nik)->whereDate('tanggal',date('Y-m-d'))->first();

            Alert::error('Anda Sudah Absen Hari Ini Pada Jam',date('H:i:s', strtotime($getinnow->check_in)));
            return redirect('kehadiran');
        }


    }



    public function check_out(Request $request, $id_presensi)
    {
        //Data Model Absensi
        $absensi = new PresensiLog();
        //Waktu keluar karyawan
        $checkout = Carbon::now();
        //request update
        $checkout = [
            'check_out' => $checkout,
            'status' => 'off_duty'
        ];

        //Data request Where;
        $id_presensi = $request->id_presensi;
        // $datenow = Carbon::now()->isoFormat('Y-MM-D');

        $absensi::where('id_presensi', $id_presensi)->update($checkout);

        return redirect('kehadiran')->with('success', 'Absen Keluar Berhasil');
    }

    public function form_keluar(PresensiLog $presensilog){
        //Tanggal Sekarang
        $datenow = Carbon::now()->isoFormat('Y-MM-D');

        //Collection adalah query tabel presensilog dengan tabel lain
        $collection = [
            'karyawans'
        ];

        //ambil id user
        $nik = auth()->user()->karyawan->nik;

        //Get Data Karwayan yang masuk Sekarang
        if($nik  == 'SA2021'){
            $getinnow = $presensilog::where('status', '=', 'on_duty')->with($collection)->get();
        }
        else{
            $getinnow = $presensilog::where('status', '=', 'on_duty')->where('tanggal',$datenow)->where('nik', $nik)->with($collection)->get();
        }


        $tanggal    = Carbon::now()->isoFormat('D');
        $bulan      = Carbon::now()->isoFormat('M');
        $tahun      = Carbon::now()->isoFormat('Y');
        $id_regu    = auth()->user()->karyawan->id_regu;

        if($id_regu == 5){
            $jadwal = JadwalShift::where('id_regu', $id_regu)->first();
        }
        else{
            $jadwal = JadwalShift::where('tanggal', $tanggal)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->where('id_regu', $id_regu)
                ->first();
        }


        return view('absensi/form_keluar', compact('getinnow','jadwal','datenow'));
    }

    public function absen(){

        $hash = new Hashids();


        return view('absensi/absen', compact('hash'),
            [
            ]);
    }

    public function list_absen_tidakmasuk()
    {

        //SUPER ADMIN
        if(auth()->user()->id_level_user == 1){
            $data = AbsensiLog::whereHas('karyawan.jabatan', function($q){
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
            ->where('reject',0)
            ->get();
        }

        //VP
        elseif(auth()->user()->id_level_user == 2){
            $data = AbsensiLog::whereNull('validasi')->orwhereNull('mengetahui')->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        //SATPAM
        elseif(auth()->user()->id_level_user == 8){
            $data = AbsensiLog::where('nik', auth()->user()->karyawan->nik)->where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        //SECURITY
        elseif(auth()->user()->id_level_user == 9){
            $data = AbsensiLog::where('nik', auth()->user()->karyawan->nik)->where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        //PAMTUP
        elseif(auth()->user()->id_level_user == 10){
            $data = AbsensiLog::where('nik', auth()->user()->karyawan->nik)->where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        //ADMIN
        elseif(auth()->user()->id_level_user == 11){
            $data = AbsensiLog::where('nik', auth()->user()->karyawan->nik)->where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }

        else{
            $data = AbsensiLog::whereHas('karyawan.jabatan', function($q){
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
            ->where('reject',0)
            ->get();
        }

        if(request()->ajax()){
        return datatables()->of($data)

                ->addColumn('action', function($data){

                    if($data->karyawan->jabatan->direct_jab_atasan == auth()->user()->karyawan->id_jabatan)
                    {

                    $disable = !is_null($data->validasi) ? 'disabled' : '';
                    $url     = !is_null($data->validasi) ? "#" : "approve_tidak_masuk"."/".$data->id_absensi;
                    $tolak   = !is_null($data->validasi) ? "#" : "reject_tidak_masuk"."/".$data->id_absensi;

                    $button =  '<a href="/detail_absen/'.$data->id_absensi.'">
                                    <button class="btn btn-primary" data-original-title="Detail">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </a>';
                    $button .= '<a href="'.$url.'">
                                    <button class="btn btn-primary" data-original-title="Approve" '.$disable.'>
                                        <i class="fa fa-check-square-o"></i>
                                    </button>
                                </a>';
                    $button .= '<a href="'.$tolak.'">
                                    <button class="btn btn-danger" data-original-title="Reject" '.$disable.'>
                                        <i class="fa fa-times"></i>
                                    </button>
                                </a>';
                    }

                    elseif($data->karyawan->jabatan->direct_jab_atasan_2 == auth()->user()->karyawan->id_jabatan){
                    $disable = is_null($data->validasi) ? 'disabled' : '';
                    $url     = is_null($data->validasi) ? "#" : "approve_tidak_masuk"."/".$data->id_absensi;
                    $tolak   = is_null($data->validasi) ? "#" : "reject_tidak_masuk"."/".$data->id_absensi;

                    $button =  '<a href="/detail_absen/'.$data->id_absensi.'">
                                    <button class="btn btn-primary" data-original-title="Detail">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </a>';

                    $button .=  '<a href="'.$url.'">
                                    <button type="button" class="btn btn-primary" '.$disable.'>
                                        <i class="fa fa-check-square-o"></i>
                                    </button>
                                </a>';
                    $button .= '<a href="'.$tolak.'">
                                    <button class="btn btn-danger" data-original-title="Reject" '.$disable.'>
                                        <i class="fa fa-times"></i>
                                    </button>
                                </a>';
                    }

                    elseif(auth()->user()->id_level_user == 1){
                    $disable = !is_null($data->validasi) ? 'disabled' : '';
                    $url     = !is_null($data->validasi) ? "#" : "approve_tidak_masuk"."/".$data->id_absensi;
                    $tolak   = !is_null($data->validasi) ? "#" : "reject_tidak_masuk"."/".$data->id_absensi;

                    $button =  '<a href="/detail_absen/'.$data->id_absensi.'">
                                    <button class="btn btn-primary" data-original-title="Detail">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </a>';

                    $button .=  '<a href="'.$url.'">
                                    <button type="button" class="btn btn-primary" '.$disable.'>
                                        <i class="fa fa-check-square-o"></i>
                                    </button>
                                </a>';
                    $button .= '<a href="'.$tolak.'">
                                    <button class="btn btn-danger" data-original-title="Reject" '.$disable.'>
                                        <i class="fa fa-times"></i>
                                    </button>
                                </a>';
                        if(!is_null($data->validasi)){
                        $button =  '<a href="/detail_absen/'.$data->id_absensi.'">
                                        <button class="btn btn-primary" data-original-title="Detail">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </a>';

                        $button .=  '<a href="/approve_tidak_masuk/'.$data->id_absensi.'">
                                        <button type="button" class="btn btn-primary">
                                            <i class="fa fa-check-square-o"></i>
                                        </button>
                                    </a>';
                        $button .= '<a href="'.$tolak.'">
                                    <button class="btn btn-danger" data-original-title="Reject" '.$disable.'>
                                        <i class="fa fa-times"></i>
                                    </button>
                                </a>';
                        }
                    }

                    else{
                    $button =  '<a href="/detail_absen/'.$data->id_absensi.'">
                                    <button class="btn btn-primary" data-original-title="Detail">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </a>';
                    }

                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        //SUPER ADMIN
        if(auth()->user()->id_level_user == 1){
            $sudah_validasi = AbsensiLog::whereHas('karyawan.jabatan', function($q){
            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('terbit','=',1);
            })
            ->orderBy('tgl_absen', 'desc')
            ->get();
        }

        elseif(auth()->user()->id_level_user == 2){
            $sudah_validasi = AbsensiLog::where('terbit','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 8){
            $sudah_validasi = AbsensiLog::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 9){
            $sudah_validasi = AbsensiLog::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 10){
            $sudah_validasi = AbsensiLog::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 11){
            $sudah_validasi = AbsensiLog::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        else{
            $sudah_validasi = AbsensiLog::whereHas('karyawan.jabatan', function($q){
                $q->where('direct_jab_atasan', auth()->user()->karyawan->id_jabatan)->orWhere('direct_jab_atasan_2', auth()->user()->karyawan->id_jabatan);
            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('terbit','=',1);
            })
            ->orderBy('tgl_absen', 'desc')
            ->get();
            }


        if(auth()->user()->id_level_user == 1){
            $reject_absen_tidak_masuk = AbsensiLog::whereHas('karyawan.jabatan', function($q){

            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('reject','=',1);
            })
            ->orderBy('tgl_absen', 'desc')
            ->get();
        }
        elseif(auth()->user()->id_level_user == 2){
            $reject_absen_tidak_masuk = AbsensiLog::where('reject','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 8){
            $reject_absen_tidak_masuk = AbsensiLog::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 9){
            $reject_absen_tidak_masuk = AbsensiLog::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 10){
            $reject_absen_tidak_masuk = AbsensiLog::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 11){
            $reject_absen_tidak_masuk = AbsensiLog::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        else{
            $reject_absen_tidak_masuk = AbsensiLog::whereHas('karyawan.jabatan', function($q){
                $q->where('direct_jab_atasan', auth()->user()->karyawan->id_jabatan)->orWhere('direct_jab_atasan_2', auth()->user()->karyawan->id_jabatan);
            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('reject','=',1);
            })
            ->orderBy('tgl_absen', 'desc')
            ->get();
        }



        $hitung_data = count($data);
        $hitung_data_sudah = count($sudah_validasi);
        $hitung_data_reject = count($reject_absen_tidak_masuk);

        return view('absensi/list_absen_tidakmasuk',[
            'total_belum_valid' => $hitung_data,
            'total_sudah_valid' => $hitung_data_sudah,
            'total_reject' => $hitung_data_reject,
        ]);
    }

    public function data_absen_sudah_valid()
    {

        //SUPER ADMIN
        if(auth()->user()->id_level_user == 1){
            $sudah_validasi = AbsensiLog::whereHas('karyawan.jabatan', function($q){
            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('terbit','=',1);
            })
            ->orderBy('tgl_absen', 'desc')
            ->get();
        }

        elseif(auth()->user()->id_level_user == 2){
            $sudah_validasi = AbsensiLog::where('terbit','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 8){
            $sudah_validasi = AbsensiLog::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 9){
            $sudah_validasi = AbsensiLog::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 10){
            $sudah_validasi = AbsensiLog::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 11){
            $sudah_validasi = AbsensiLog::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        else{
            $sudah_validasi = AbsensiLog::whereHas('karyawan.jabatan', function($q){
                $q->where('direct_jab_atasan', auth()->user()->karyawan->id_jabatan)->orWhere('direct_jab_atasan_2', auth()->user()->karyawan->id_jabatan);
            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('terbit','=',1);
            })
            ->orderBy('tgl_absen', 'desc')
            ->get();
            }

            if(request()->ajax()){
            return datatables()->of($sudah_validasi)
                ->addColumn('action', function($sudah_validasi){

                        $button =  '<a href="/detail_absen/'.$sudah_validasi->id_absensi.'">
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

        return view('absensi/list_absen_tidakmasuk');
    }

    public function data_absen_reject()
    {

        if(auth()->user()->id_level_user == 1){
            $reject_absen_tidak_masuk = AbsensiLog::whereHas('karyawan.jabatan', function($q){

            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('reject','=',1);
            })
            ->orderBy('tgl_absen', 'desc')
            ->get();
        }
        elseif(auth()->user()->id_level_user == 2){
            $reject_absen_tidak_masuk = AbsensiLog::where('reject','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 8){
            $reject_absen_tidak_masuk = AbsensiLog::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 9){
            $reject_absen_tidak_masuk = AbsensiLog::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 10){
            $reject_absen_tidak_masuk = AbsensiLog::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 11){
            $reject_absen_tidak_masuk = AbsensiLog::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        else{
            $reject_absen_tidak_masuk = AbsensiLog::whereHas('karyawan.jabatan', function($q){
                $q->where('direct_jab_atasan', auth()->user()->karyawan->id_jabatan)->orWhere('direct_jab_atasan_2', auth()->user()->karyawan->id_jabatan);
            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('reject','=',1);
            })
            ->orderBy('tgl_absen', 'desc')
            ->get();
        }

        if(request()->ajax()){
        return datatables()->of($reject_absen_tidak_masuk)
            ->addColumn('action', function($reject_absen_tidak_masuk){

                    $button =  '<a href="/detail_absen/'.$reject_absen_tidak_masuk->id_absensi.'">
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

        return view('absensi/list_absen_tidakmasuk');
    }

    public function detail_absen(Request $request)
    {

        $dt_absen = DB::table('absensi_logs')
                    ->join('karyawans','karyawans.nik','=','absensi_logs.nik')
                    ->join('users','users.nik','=','absensi_logs.nik')
                    ->select('absensi_logs.id_absensi','absensi_logs.nik','absensi_logs.tgl_absen','absensi_logs.tipe_absen','absensi_logs.detail','absensi_logs.bukti','absensi_logs.validasi','absensi_logs.mengetahui','absensi_logs.terbit','absensi_logs.reject','absensi_logs.reject_by',
                    'karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan','users.foto',
                    'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                    'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif')
                    ->where('absensi_logs.id_absensi', '=', $request->id_absensi)
                    ->first();

        $nama = Karyawan::where('nik',$dt_absen->nik)->with('jabatan.atasan_1','jabatan.atasan_2')->first();

        $nama_reject = AbsensiLog::where('id_absensi',$request->id_absensi)->with('reject')->first();

        return view('absensi/detail_absen',[
            'data_absen' => $dt_absen,
            'jab' => $nama,
            'rej' => $nama_reject,
        ]);
    }

    public function form_ijin(Request $request, $nik){

        // $nik = $request->nik;
        $nik = auth()->user()->nik;

        if($nik  == 'SA2021'){
            $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->distinct()
                ->orderBy('karyawans.id_karyawan', 'asc')
                ->get();
        }
        else{
            $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->distinct()
                ->where('karyawans.nik', $nik)
                ->orderBy('karyawans.id_karyawan', 'asc')
                ->get();
        }

        return view('absensi/form_ijin',
            [
                'data_kar' => $dt_kar,
            ]);
    }

    function ijin_submit(Request $request)
    {

        $tgl = $request->tgl_absen;
        $tgl_absen = date("Y-m-d", strtotime($tgl));

        $tanggal    = date("d", strtotime($tgl));
        $bulan      = date("m", strtotime($tgl));
        $tahun      = date("Y", strtotime($tgl));
        $id_regu    = $request->id_regu;

        if($id_regu == '5'){
            $jadwal = JadwalShift::where('id_regu', $id_regu)
                    ->first();
        }
        else{
            $jadwal = JadwalShift::where('tanggal', $tanggal)
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->where('id_regu', $id_regu)
                    ->first();
        }

        $cek_tanggal_presensi = DB::table('presensi_logs')->where('nik',$request->niknik)->where('tanggal',$tgl_absen)->first();

        $nama_lengkap = $request->nama_lengkap;
        $tgl_tdk_msk = date("d-m-Y", strtotime($tgl));

        if(is_null($cek_tanggal_presensi) && $jadwal->action != "OFF"){
            $absensi                        = new AbsensiLog();
            $absensi->nik                   = $request->niknik;
            $absensi->tgl_absen             = $tgl_absen;
            $absensi->tipe_absen            = $request->tipe_absen;
            $absensi->detail                = $request->detail_absen;
            $absensi->validasi              = null;
            $absensi->mengetahui            = null;
            $absensi->terbit                = "0";
            $absensi->reject                = "0";
            $absensi->save();

            $notifikasi                      = new Notifikasi();
            $notifikasi->kategori_notifikasi = "Pengajuan";
            $notifikasi->judul_notifikasi    = "Pengajuan Ijin";
            $notifikasi->isi_notifikasi      = $nama_lengkap. " Mengajukan Ijin Tidak Masuk Kerja pada tanggal " .$tgl_tdk_msk;
            $notifikasi->user_id_penerima    = $request->user_id_penerima;
            $notifikasi->status              = 0;
            $notifikasi->save();

            $notifikasi->save();

            return redirect('absen')->with('success', 'Pengajuan Ijin Berhasil');
        }
        elseif($jadwal->action == "OFF"){
            Alert::error('Jadwal anda pada hari ini adalah OFF','Gagal Mengajukan Ijin');
            return redirect('absen');
        }
        else{
            Alert::error('Jadwal anda pada hari ini sudah terisi','Gagal Mengajukan Ijin');
            return redirect('absen');
        }

        // $waktuabsen = date('H:i:s l jS F Y');
        // $now=date('H.i');

        // $bukti_sakit = $request->file('gambar');
        // $bukti = rand() . '.' . $bukti_sakit->getClientOriginalExtension();
        // $bukti_sakit->move(public_path('assets/foto_profil'), $bukti);

        // $tgl = $request->tgl_absen->format('Y-MM-D');
        // $tgl =date('Y-MM-D', strtotime($request->tgl_absen));
        // $tgl = Carbon::parse($request->tgl_absen)->format('Y-MM-D');

            // $tgl                            = $request->tgl_absen;
            // $tgl_absen                      = date("YYYY-mm-dd", strtotime($tgl));

            // $request->request->add(['absensi' => $absensi->id_absensi ]);
            // $hadir                          = new PresensiLog();
            // $hadir->nik                     = $request->niknik;
            // $hadir->tanggal                 = $tgl_absen;
            // $hadir->jadwal_kerja            = "Ijin";
            // $hadir->lat                     = "None";
            // $hadir->lng                     = "None";
            // $hadir->id_zona                 = $request->id_zona;
            // $hadir->id_regu                 = $request->id_regu;
            // $hadir->id_jabatan              = $request->id_jabatan;
            // $hadir->check_in                = "Libur - Ijin";
            // $hadir->check_out               = "Libur - Ijin";
            // $hadir->status                  = "off_duty";
            // $hadir->detail                  = $request->detail;
            // $hadir->id_absensi              = $request->absensi;
            // $hadir->save();
    }

    public function form_dispensasi(Request $request, $nik){

        $nik = $request->nik;

        if($nik  == 'SA2021'){
            $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->distinct()
                ->orderBy('karyawans.id_karyawan', 'asc')
                ->get();
        }
        else{
            $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->distinct()
                ->where('karyawans.nik', $nik)
                ->orderBy('karyawans.id_karyawan', 'asc')
                ->get();
        }

        return view('absensi/form_dispensasi',
            [
                'data_kar' => $dt_kar,
            ]);
    }

    function dispensasi_submit(Request $request)
    {

        $tgl = $request->tgl_absen;
        $tgl_absen = date("Y-m-d", strtotime($tgl));

        $tanggal    = date("d", strtotime($tgl));
        $bulan      = date("m", strtotime($tgl));
        $tahun      = date("Y", strtotime($tgl));
        $id_regu    = $request->id_regu;

        if($id_regu == '5'){
            $jadwal = JadwalShift::where('id_regu', $id_regu)
                    ->first();
        }
        else{
            $jadwal = JadwalShift::where('tanggal', $tanggal)
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->where('id_regu', $id_regu)
                    ->first();
        }

        $cek_tanggal_presensi = DB::table('presensi_logs')->where('nik',$request->niknik)->where('tanggal',$tgl_absen)->first();

        $nama_lengkap = $request->nama_lengkap;
        $tgl_tdk_msk = date("d-m-Y", strtotime($tgl));

        if(is_null($cek_tanggal_presensi) && $jadwal->action != "OFF"){
            $absensi                        = new AbsensiLog();
            $absensi->nik                   = $request->niknik;
            $absensi->tgl_absen             = $tgl_absen;
            $absensi->tipe_absen            = $request->tipe_absen;
            $absensi->detail                = $request->detail_absen;
            $absensi->validasi              = null;
            $absensi->mengetahui            = null;
            $absensi->terbit                = "0";
            $absensi->reject                = "0";
            $absensi->save();

            $notifikasi                      = new Notifikasi();
            $notifikasi->kategori_notifikasi = "Pengajuan";
            $notifikasi->judul_notifikasi    = "Pengajuan Dispensasi";

            $notifikasi->isi_notifikasi      = $nama_lengkap. " Mengajukan Dispensasi Tidak Masuk Kerja pada tanggal " .$tgl_tdk_msk;
            $notifikasi->user_id_penerima    = $request->user_id_penerima;
            $notifikasi->status              = 0;
            $notifikasi->save();

            return redirect('absen')->with('success', 'Pengajuan Berhasil');
        }
        elseif($jadwal->action == "OFF"){
            Alert::error('Jadwal anda pada hari ini adalah OFF','Gagal Mengajukan Dispensasi');
            return redirect('absen');
        }
        else{
            Alert::error('Jadwal anda pada hari ini sudah terisi','Gagal Mengajukan Dispensasi');
            return redirect('absen');
        }

        // $request->request->add(['absensi' => $absensi->id_absensi]);

        // $hadir                          = new PresensiLog();
        // $hadir->nik                     = $request->niknik;
        // $hadir->tanggal                 = $tgl_absen;
        // $hadir->jadwal_kerja            = $request->tipe_absen;
        // $hadir->lat                     = "None";
        // $hadir->lng                     = "None";
        // $hadir->id_zona                 = $request->id_zona;
        // $hadir->id_regu                 = $request->id_regu;
        // $hadir->id_jabatan              = $request->id_jabatan;
        // $hadir->check_in                = "Libur - Dispensasi";
        // $hadir->check_out               = "Libur - Dispensasi";
        // $hadir->status                  = "off_duty";
        // $hadir->detail                  = $request->detail;
        // $hadir->id_absensi              = $request->absensi;
        // $hadir->save();

        return redirect('absen')->with('success', 'Absen Masuk Berhasil');
    }

    public function form_cuti(Request $request, $nik){

        // $nik = $request->nik;
        $nik = auth()->user()->nik;

        if($nik  == 'SA2021'){
            $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->distinct()
                ->orderBy('karyawans.id_karyawan', 'asc')
                ->get();
        }
        else{
            $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->distinct()
                ->where('karyawans.nik', $nik)
                ->orderBy('karyawans.id_karyawan', 'asc')
                ->get();
        }

        $sisa_cuti = DB::table('karyawans')->where('nik', $nik)->first();

        return view('absensi/form_cuti',
            [
                'data_kar' => $dt_kar,
                'sisa_cuti' => $sisa_cuti
            ]);
    }

    function cuti_submit(Request $request)
    {

        $tgl = $request->tgl_absen;
        $tgl_absen = date("Y-m-d", strtotime($tgl));

        $tanggal    = date("d", strtotime($tgl));
        $bulan      = date("m", strtotime($tgl));
        $tahun      = date("Y", strtotime($tgl));
        $id_regu    = $request->id_regu;

        if($id_regu == '5'){
            $jadwal = JadwalShift::where('id_regu', $id_regu)
                    ->first();
        }
        else{
            $jadwal = JadwalShift::where('tanggal', $tanggal)
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->where('id_regu', $id_regu)
                    ->first();
        }

        $cek_tanggal_presensi = DB::table('presensi_logs')->where('nik',$request->niknik)->where('tanggal',$tgl_absen)->first();

        $nama_lengkap = $request->nama_lengkap;
        $tgl_tdk_msk = date("d-m-Y", strtotime($tgl));

        $data_karyawan = DB::table('karyawans')->where('nik',$request->niknik)->first();
        $sisa_cuti     = $data_karyawan->sisa_cuti;

        if ($sisa_cuti != 0) {
            if(is_null($cek_tanggal_presensi) && $jadwal->action != "OFF"){
                $absensi                        = new AbsensiLog();
                $absensi->nik                   = $request->niknik;
                $absensi->tgl_absen             = $tgl_absen;
                $absensi->tipe_absen            = $request->tipe_absen;
                $absensi->detail                = $request->detail_absen;
                $absensi->validasi              = null;
                $absensi->mengetahui            = null;
                $absensi->terbit                = "0";
                $absensi->reject                = "0";
                $absensi->save();

                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Pengajuan";
                $notifikasi->judul_notifikasi    = "Pengajuan Cuti";
                $notifikasi->isi_notifikasi      = $nama_lengkap. " Mengajukan Cuti Tidak Masuk Kerja pada tanggal " .$tgl_tdk_msk;
                $notifikasi->user_id_penerima    = $request->user_id_penerima;
                $notifikasi->status              = 0;
                $notifikasi->save();

                return redirect('absen')->with('success', 'Pengajuan Cuti Berhasil');
            }
            elseif($jadwal->action == "OFF"){
                Alert::error('Jadwal anda pada hari ini adalah OFF','Gagal Mengajukan Cuti');
                return redirect('absen');
            }
            else{
                Alert::error('Jadwal anda pada hari ini sudah terisi','Gagal Mengajukan Cuti');
                return redirect('absen');
            }
        }
        else{

            return redirect('absen')->with('danger', 'Sisa Cuti Anda Telah Habis');
        }



        // $request->request->add(['absensi' => $absensi->id_absensi]);

        // $hadir                          = new PresensiLog();
        // $hadir->nik                     = $request->niknik;
        // $hadir->tanggal                 = $tgl_absen;
        // $hadir->jadwal_kerja            = $request->tipe_absen;
        // $hadir->lat                     = "None";
        // $hadir->lng                     = "None";
        // $hadir->id_zona                 = $request->id_zona;
        // $hadir->id_regu                 = $request->id_regu;
        // $hadir->id_jabatan              = $request->id_jabatan;
        // $hadir->check_in                = "Libur - Cuti";
        // $hadir->check_out               = "Libur - Cuti";
        // $hadir->status                  = "off_duty";
        // $hadir->detail                  = $request->detail;
        // $hadir->id_absensi              = $request->absensi;
        // $hadir->save();

        return redirect('absen')->with('success', 'Absen Masuk Berhasil');
    }

    public function form_sakit(Request $request, $nik){

        $nik = $request->nik;

        if($nik  == 'SA2021'){
            $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->distinct()
                ->orderBy('karyawans.id_karyawan', 'asc')
                ->get();
        }
        else{
            $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->distinct()
                ->where('karyawans.nik', $nik)
                ->orderBy('karyawans.id_karyawan', 'asc')
                ->get();
        }

        return view('absensi/form_sakit',
            [
                'data_kar' => $dt_kar,
            ]);
    }

    function sakit_submit(Request $request)
    {

        $request->validate([
            'gambar' => 'mimes:jpg,png,jpeg|max:3000',
        ]);

        $bukti_sakit = $request->file('gambar');
        $bukti = rand() . '.' . $bukti_sakit->getClientOriginalExtension();
        $bukti_sakit->move(public_path('assets/foto_bukti_sakit'), $bukti);

        $tgl = $request->tgl_absen;
        $tgl_absen = date("Y-m-d", strtotime($tgl));

        $tanggal    = date("d", strtotime($tgl));
        $bulan      = date("m", strtotime($tgl));
        $tahun      = date("Y", strtotime($tgl));
        $id_regu    = $request->id_regu;

        if($id_regu == '5'){
            $jadwal = JadwalShift::where('id_regu', $id_regu)
                    ->first();
        }
        else{
            $jadwal = JadwalShift::where('tanggal', $tanggal)
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->where('id_regu', $id_regu)
                    ->first();
        }

        $cek_tanggal_presensi = DB::table('presensi_logs')->where('nik',$request->niknik)->where('tanggal',$tgl_absen)->first();

        $nama_lengkap = $request->nama_lengkap;
        $tgl_tdk_msk = date("d-m-Y", strtotime($tgl));

        if(is_null($cek_tanggal_presensi) && $jadwal->action != "OFF"){
            $absensi                        = new AbsensiLog();
            $absensi->nik                   = $request->niknik;
            $absensi->tgl_absen             = $tgl_absen;
            $absensi->tipe_absen            = $request->tipe_absen;
            $absensi->detail                = $request->detail_absen;
            $absensi->bukti                 = $bukti;
            $absensi->validasi              = null;
            $absensi->mengetahui            = null;
            $absensi->terbit                = "0";
            $absensi->reject                = "0";
            $absensi->save();

            $notifikasi                      = new Notifikasi();
            $notifikasi->kategori_notifikasi = "Pengajuan";
            $notifikasi->judul_notifikasi    = "Pengajuan Sakit";
            $notifikasi->isi_notifikasi      = $nama_lengkap. " Mengajukan Sakit Tidak Masuk Kerja pada tanggal " .$tgl_tdk_msk;
            $notifikasi->user_id_penerima    = $request->user_id_penerima;
            $notifikasi->status              = 0;
            $notifikasi->save();

            return redirect('absen')->with('success', 'Pengajuan Berhasil');
        }
        elseif($jadwal->action == "OFF"){
            Alert::error('Jadwal anda pada hari ini adalah OFF','Gagal Mengajukan Sakit');
            return redirect('absen');
        }
        else{
            Alert::error('Jadwal anda pada hari ini sudah terisi','Gagal Mengajukan Sakit');
            return redirect('absen');
        }

        // $request->request->add(['absensi' => $absensi->id_absensi ]);

        // $hadir                          = new PresensiLog();
        // $hadir->nik                     = $request->niknik;
        // $hadir->tanggal                 = $tgl_absen;
        // $hadir->jadwal_kerja            = $request->tipe_absen;
        // $hadir->lat                     = "None";
        // $hadir->lng                     = "None";
        // $hadir->id_zona                 = $request->id_zona;
        // $hadir->id_regu                 = $request->id_regu;
        // $hadir->id_jabatan              = $request->id_jabatan;
        // $hadir->check_in                = "Libur - Sakit";
        // $hadir->check_out               = "Libur - Sakit";
        // $hadir->status                  = "off_duty";
        // $hadir->detail                  = $request->detail;
        // $hadir->id_absensi              = $request->absensi;
        // $hadir->save();

        return redirect('absen')->with('success', 'Absen Masuk Berhasil');
    }

    public function pengajuan(){

        $hash = new Hashids();

        return view('absensi/pengajuan', compact('hash'),
            [

            ]);
    }

    public function list_pengajuan(){


        return view('absensi/list_pengajuan',
            [

            ]);
    }

    public function form_tukar_shift(Request $request, $nik){

        $nik = $request->nik;
        $id_zona = auth()->user()->karyawan->id_zona;

        $dt_karyawan_p1 = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->distinct()
                ->where('karyawans.nik', $nik)
                ->orderBy('karyawans.id_karyawan', 'asc')
                ->get();

        return view('absensi/form_tukar_shift',
            [
                'data_karyawan_p1' => $dt_karyawan_p1,
                // 'data_karyawan_p2' => $dt_karyawan_p2,
            ]);
    }

    function tukar_shift_submit(Request $request)
    {

        $start_date = date_parse_from_format('d/m/Y',$request->tgl_tukar);
        $tgl_tukar = $start_date['year'].'-'.$start_date['month'].'-'.$start_date['day'];

        $tgl_tukar_not = $start_date['day'].'-'.$start_date['month'].'-'.$start_date['year'];

        $start_date = date_parse_from_format('d/m/Y',$request->tgl_tukar);


        $tukar_shift                        = new TukarShift();
        $tukar_shift->tgl_tukar             = $tgl_tukar;
        $tukar_shift->nik_pihak1            = $request->nik_pihak1;
        $tukar_shift->nik_pihak2            = $request->nik_pihak2;
        $tukar_shift->nik_kajaga_pihak1     = $request->nik_kajaga_pihak1;
        $tukar_shift->nik_kajaga_pihak2     = $request->nik_kajaga_pihak2;
        $tukar_shift->awal_jam_kerja        = $request->awal_jam_kerja;
        $tukar_shift->ubah_jam_kerja        = $request->ubah_jam_kerja;
        $tukar_shift->apv_pihak2            = null;
        $tukar_shift->apv_kajaga_p1         = null;
        $tukar_shift->apv_kajaga_p2         = null;
        $tukar_shift->terbit                = "0";
        $tukar_shift->reject                = "0";
        $tukar_shift->save();

        $notifikasi                         = new Notifikasi();
        $notifikasi->kategori_notifikasi    = "Pengajuan";
        $notifikasi->judul_notifikasi       = "Pengajuan Tukar Shift";
        $notifikasi->isi_notifikasi         = $request->nama_lengkap_pembuat." mengajukan Tukar Shift kepada " .$request->nama_lengkap. " pada tanggal ". $tgl_tukar_not . " dengan rincian jadwal ".$request->nama_lengkap. " seharusnya | ". $request->awal_jam_kerja . " menjadi " . $request->ubah_jam_kerja ." perlu persetujuan dari ".$request->nama_lengkap;
        $notifikasi->user_id_penerima       = $request->id_user_penerima_1;
        $notifikasi->status                 = 0;
        $notifikasi->save();

        // $notifikasi                         = new Notifikasi();
        // $notifikasi->kategori_notifikasi    = "Pengajuan";
        // $notifikasi->judul_notifikasi       = "Pengajuan Tukar Shift";
        // $notifikasi->isi_notifikasi         = $request->nama_lengkap_pembuat." mengajukan Tukar Shift kepada " .$request->nama_lengkap. " pada tanggal ". $tgl_tukar_not . " dengan rincian jadwal ".$request->nama_lengkap. " seharusnya | ". $request->awal_jam_kerja . " menjadi " . $request->ubah_jam_kerja ." perlu persetujuan dari ".$request->apv_kajaga_p1;
        // $notifikasi->user_id_penerima       = $request->id_user_penerima_2;
        // $notifikasi->status                 = 0;
        // $notifikasi->save();

        // $notifikasi                         = new Notifikasi();
        // $notifikasi->kategori_notifikasi    = "Pengajuan";
        // $notifikasi->judul_notifikasi       = "Pengajuan Tukar Shift";
        // $notifikasi->isi_notifikasi         = $request->nama_lengkap_pembuat." mengajukan Tukar Shift kepada " .$request->nama_lengkap. " pada tanggal ". $tgl_tukar_not . " dengan rincian jadwal ".$request->nama_lengkap. " seharusnya | ". $request->awal_jam_kerja . " menjadi " . $request->ubah_jam_kerja ." perlu persetujuan dari ".$request->apv_kajaga_p2;
        // $notifikasi->user_id_penerima       = $request->id_user_penerima_3;
        // $notifikasi->status                 = 0;
        // $notifikasi->save();


        return redirect('pengajuan')->with('success_ts', 'Tambah Form Tukar Shift Berhasil');
    }

    public function list_tukar_shift()
    {

        //SUPERADMIN
        if(auth()->user()->id_level_user == 1){
            $data = TukarShift::whereHas('karyawan.jabatan', function($q){
            })
            ->with('karyawan', function($q){
                $q->select('id_karyawan', 'nik_pihak1', 'id_jabatan', 'nama_lengkap')->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->whereNull('apv_pihak2')->orwhereNull('apv_kajaga_p1')->orwhereNull('apv_kajaga_p2');
            })
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
         //ADMIN APK
        if(auth()->user()->id_level_user == 12){
            $data = TukarShift::where('terbit',0)->where('reject',1)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //VP
        elseif(auth()->user()->id_level_user == 2){
            $data = TukarShift::where('terbit',0)->where('reject',1)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //AVP
        elseif(auth()->user()->id_level_user == 3){
            $data = TukarShift::where('terbit',0)->where('reject',1)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //SPV
        elseif(auth()->user()->id_level_user == 4){
            $data = TukarShift::where('terbit',0)->where(function($q){
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
            $data = TukarShift::where('terbit',0)->where(function($q){
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
            $data = TukarShift::where('terbit',0)->where(function($q){
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

            $data = TukarShift::where('terbit',0)->where(function($q){
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
            $data = TukarShift::where('terbit',0)->where(function($q){
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
            $data = TukarShift::where('nik_pihak1', auth()->user()->karyawan->nik)->where('terbit',0)->where('reject',0)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }

        // else{
        // $data = TukarShift::whereHas('karyawan.jabatan', function($q){
        //     $q->where('direct_jab_atasan', auth()->user()->karyawan->id_jabatan)->orWhere('direct_jab_atasan_2', auth()->user()->karyawan->id_jabatan);
        // })
        // ->with('karyawan', function($q){
        //     $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')->with('jabatan', function($q){
        //         $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
        //     });
        // })
        // ->where(function($q){
        //     $q->whereNull('apv_pihak2')->orWhereNull('apv_kajaga_p1')->orWhereNull('apv_kajaga_p2');
        // })
        // ->orderBy('tgl_tukar', 'desc')
        // ->get();
        // }

        if(request()->ajax()){
        return datatables()->of($data)
        ->addColumn('action', function($data){

                    if($data->nik_pihak2 == auth()->user()->nik)
                    {

                        $disable = !is_null($data->apv_pihak2) ? 'disabled' : '';
                        $url     = !is_null($data->apv_pihak2) ? "#" : "approve_tukar_shift"."/".$data->id_tukar_shift;
                        $tolak   = !is_null($data->apv_pihak2) ? "#" : "reject_tukar_shift"."/".$data->id_tukar_shift;

                        $button =  '<a href="/detail_tukar_shift/'.$data->id_tukar_shift.'">
                                        <button class="btn btn-primary" data-original-title="Detail">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </a>';

                        $button .= '<a href="'.$url.'">
                                        <button class="btn btn-primary" data-original-title="Approve" '.$disable.'>
                                            <i class="fa fa-check-square-o"></i>
                                        </button>
                                    </a>';

                        $button .= '<a href="'.$tolak.'">
                                        <button class="btn btn-danger" data-original-title="Reject" '.$disable.'>
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </a>';

                        // $button  =  '<a href=/approve_tidak_masuk/'.$data->id_absensi.' class="btn btn-primary" data-original-title="Validasi">
                        //                 <i class="fa fa-check-square-o"</i>
                        //             </a>';
                    }

                    elseif($data->nik_kajaga_pihak1 == auth()->user()->nik)
                    {

                        // if(is_null($data->apv_pihak2) && !is_null($data->apv_kajaga_p1)){

                        if(!is_null($data->apv_kajaga_p1) && $data->nik_kajaga_pihak2 == auth()->user()->nik ){
                            $disable = is_null($data->apv_pihak2) ? 'disabled' : '';
                            $url     = is_null($data->apv_pihak2) ? "#" : "approve_tukar_shift"."/".$data->id_tukar_shift;
                            $tolak   = is_null($data->apv_pihak2) ? "#" : "reject_tukar_shift"."/".$data->id_tukar_shift;

                            $button =  '<a href="/detail_tukar_shift/'.$data->id_tukar_shift.'">
                                        <button class="btn btn-primary" data-original-title="Detail">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </a>';
                            $button .= '<a href="'.$url.'">
                                        <button class="btn btn-primary" data-original-title="Approve" '.$disable.'>
                                            <i class="fa fa-check-square-o"></i>
                                        </button>
                                    </a>';

                            $button .= '<a href="'.$tolak.'">
                                        <button class="btn btn-danger" data-original-title="Reject" '.$disable.'>
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </a>';
                        }
                        elseif(!is_null($data->apv_kajaga_p1)){
                            $button =  '<a href="/detail_tukar_shift/'.$data->id_tukar_shift.'">
                                <button class="btn btn-primary" data-original-title="Detail">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </a>';
                        }
                        else{
                        $disable = is_null($data->apv_pihak2) ? 'disabled' : '';
                        $url     = is_null($data->apv_pihak2) ? "#" : "approve_tukar_shift"."/".$data->id_tukar_shift;
                        $tolak   = is_null($data->apv_pihak2) ? "#" : "reject_tukar_shift"."/".$data->id_tukar_shift;

                        $button =  '<a href="/detail_tukar_shift/'.$data->id_tukar_shift.'">
                                        <button class="btn btn-primary" data-original-title="Detail">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </a>';

                        $button .= '<a href="'.$url.'">
                                        <button class="btn btn-primary" data-original-title="Approve" '.$disable.'>
                                            <i class="fa fa-check-square-o"></i>
                                        </button>
                                    </a>';

                        $button .= '<a href="'.$tolak.'">
                                        <button class="btn btn-danger" data-original-title="Reject" '.$disable.'>
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </a>';
                        }
                        // }
                        // else{
                        //     $disable =!is_null($data->apv_kajaga_p1) ? 'disabled' : '';
                        //     $url     =!is_null($data->apv_kajaga_p1) ? "#" : "approve_tukar_shift"."/".$data->id_tukar_shift;
                        //     $tolak   =!is_null($data->apv_kajaga_p1) ? "#" : "reject_tukar_shift"."/".$data->id_tukar_shift;

                        //     $button =  '<a href="/detail_tukar_shift/'.$data->id_tukar_shift.'">
                        //                     <button class="btn btn-primary" data-original-title="Detail">
                        //                         <i class="fa fa-eye"></i>
                        //                     </button>
                        //                 </a>';

                        //     $button .= '<a href="'.$url.'">
                        //                     <button class="btn btn-primary" data-original-title="Approve" '.$disable.'>
                        //                         <i class="fa fa-check-square-o"></i>
                        //                     </button>
                        //                 </a>';

                        //     $button .= '<a href="'.$tolak.'">
                        //                     <button class="btn btn-danger" data-original-title="Reject" '.$disable.'>
                        //                         <i class="fa fa-times"></i>
                        //                     </button>
                        //                 </a>';
                        // }

                    }

                    elseif($data->nik_kajaga_pihak2 == auth()->user()->nik){
                        $disable = is_null($data->apv_kajaga_p1) ? 'disabled' : '';
                        $url     = is_null($data->apv_kajaga_p1) ? "#" : "approve_tukar_shift"."/".$data->id_tukar_shift;
                        $tolak   = is_null($data->apv_kajaga_p1) ? "#" : "reject_tukar_shift"."/".$data->id_tukar_shift;

                        $button =  '<a href="/detail_tukar_shift/'.$data->id_tukar_shift.'">
                                        <button class="btn btn-primary" data-original-title="Detail">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </a>';

                        $button .= '<a href="'.$url.'">
                                        <button class="btn btn-primary" data-original-title="Approve" '.$disable.'>
                                            <i class="fa fa-check-square-o"></i>
                                        </button>
                                    </a>';

                        $button .= '<a href="'.$tolak.'">
                                        <button class="btn btn-danger" data-original-title="Reject" '.$disable.'>
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </a>';
                    }

                    // elseif(auth()->user()->id_level_user == 3)
                    // {

                    //     $disable = is_null($data->apv_kajaga_p1) ? 'disabled' : '';
                    //     $url     = is_null($data->apv_kajaga_p1) ? "#" : "approve_tukar_shift"."/".$data->id_tukar_shift;
                    //     $tolak   = is_null($data->apv_kajaga_p1) ? "#" : "reject_tukar_shift"."/".$data->id_tukar_shift;

                    //     $button =  '<a href="/detail_tukar_shift/'.$data->id_tukar_shift.'">
                    //                     <button class="btn btn-primary" data-original-title="Detail">
                    //                         <i class="fa fa-eye"></i>
                    //                     </button>
                    //                 </a>';

                    //     $button .= '<a href="'.$url.'">
                    //                     <button class="btn btn-primary" data-original-title="Approve" '.$disable.'>
                    //                         <i class="fa fa-check-square-o"></i>
                    //                     </button>
                    //                 </a>';

                    //     $button .= '<a href="'.$tolak.'">
                    //                     <button class="btn btn-danger" data-original-title="Reject" '.$disable.'>
                    //                         <i class="fa fa-times"></i>
                    //                     </button>
                    //                 </a>';

                    // }

                    elseif(auth()->user()->id_level_user == 1){
                    $disable = !is_null($data->validasi) ? 'disabled' : '';
                    $url     = !is_null($data->validasi) ? "#" : "approve_lembur_khusus"."/".$data->id_lembur_khusus;
                    $tolak   = is_null($data->mengetahui) ? "#" : "reject_lembur_khusus"."/".$data->id_lembur_khusus;

                    $button =  '<a href="/detail_lembur_khusus/'.$data->id_lembur_khusus.'">
                                    <button class="btn btn-primary" data-original-title="Detail">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </a>';

                    $button .=  '<a href="'.$url.'">
                                    <button type="button" class="btn btn-primary" '.$disable.'>
                                        <i class="fa fa-check-square-o"></i>
                                    </button>
                                </a>';

                    $button .= '<a href="'.$tolak.'">
                                    <button class="btn btn-danger" data-original-title="Reject" '.$disable.'>
                                        <i class="fa fa-times"></i>
                                    </button>
                                </a>';

                        if(!is_null($data->validasi)){
                        $button =  '<a href="/detail_lembur_khusus/'.$data->id_lembur_khusus.'">
                                        <button class="btn btn-primary" data-original-title="Detail">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </a>';

                        $button .=  '<a href="/approve_lembur_khusus/'.$data->id_lembur_khusus.'">
                                        <button type="button" class="btn btn-primary">
                                            <i class="fa fa-check-square-o"></i>
                                        </button>
                                    </a>';

                        $button .=  '<a href="/reject_lembur_khusus/'.$data->id_lembur_khusus.'">
                                        <button type="button" class="btn btn-primary">
                                            <i class="fa fa-check-square-o"></i>
                                        </button>
                                    </a>';
                        }
                    }

                    else{
                    $button =  '<a href="/detail_tukar_shift/'.$data->id_tukar_shift.'">
                                    <button class="btn btn-primary" data-original-title="Detail">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </a>';

                    }

                    return $button;
                })

                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }





        //SUPERADMIN
        if(auth()->user()->id_level_user == 1){
            $sudah_validasi = TukarShift::whereHas('karyawan.jabatan', function($q){
            })
            ->with('karyawan', function($q){
                $q->select('id_karyawan', 'nik_pihak1', 'id_jabatan', 'nama_lengkap')->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->whereNull('apv_pihak2')->orwhereNull('apv_kajaga_p1')->orwhereNull('apv_kajaga_p2');
            })
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //ADMIN APK
        elseif(auth()->user()->id_level_user == 12){
            $sudah_validasi = TukarShift::whereNull('apv_pihak2')->orwhereNull('apv_kajaga_p1')->orwhereNull('apv_kajaga_p2')->where('terbit',1)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //VP
        elseif(auth()->user()->id_level_user == 2){
            $sudah_validasi = TukarShift::whereNull('apv_pihak2')->orwhereNull('apv_kajaga_p1')->orwhereNull('apv_kajaga_p2')->where('terbit',1)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //AVP
        elseif(auth()->user()->id_level_user == 3){
            $sudah_validasi = TukarShift::whereNull('apv_pihak2')->orwhereNull('apv_kajaga_p1')->orwhereNull('apv_kajaga_p2')->where('terbit',1)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //SVP
        elseif(auth()->user()->id_level_user == 4){
            $sudah_validasi = TukarShift::where('terbit',1)->where(function($q){
                $q->orWhere('nik_kajaga_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_kajaga_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //FOREMAN
        elseif(auth()->user()->id_level_user == 6){
        $sudah_validasi = TukarShift::where('terbit',1)->where(function($q){
                $q->orWhere('nik_kajaga_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_kajaga_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //KAJAGA
        elseif(auth()->user()->id_level_user == 7){
            $sudah_validasi = TukarShift::where('terbit',1)->where(function($q){
                $q->orWhere('nik_kajaga_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_kajaga_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //SATPAM
        elseif(auth()->user()->id_level_user == 8){
            $sudah_validasi = TukarShift::where('terbit',1)->where(function($q){
                $q->orWhere('nik_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //SECURITY
        elseif(auth()->user()->id_level_user == 9){
            $sudah_validasi = TukarShift::where('terbit',1)->where(function($q){
                $q->orWhere('nik_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //ADMIN
        elseif(auth()->user()->id_level_user == 11){
            $sudah_validasi = TukarShift::where('nik_pihak1', auth()->user()->karyawan->nik)->where('terbit',1)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }






        //SUPERADMIN
        if(auth()->user()->id_level_user == 1){
            $reject_ts = TukarShift::whereHas('karyawan.jabatan', function($q){
            })
            ->with('karyawan', function($q){
                $q->select('id_karyawan', 'nik_pihak1', 'id_jabatan', 'nama_lengkap')->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->whereNull('apv_pihak2')->orwhereNull('apv_kajaga_p1')->orwhereNull('apv_kajaga_p2');
            })
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //ADMIN APK
        elseif(auth()->user()->id_level_user == 12){
            $reject_ts = TukarShift::where('reject',1)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //VP
        elseif(auth()->user()->id_level_user == 2){
            $reject_ts = TukarShift::where('reject',1)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //AVP
        elseif(auth()->user()->id_level_user == 3){
            $reject_ts = TukarShift::where('reject',1)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //SVP
        elseif(auth()->user()->id_level_user == 4){
            $reject_ts = TukarShift::where('reject',1)->where(function($q){
                $q->orWhere('nik_kajaga_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_kajaga_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //FOREMAN
        elseif(auth()->user()->id_level_user == 6){
        $reject_ts = TukarShift::where('reject',1)->where(function($q){
                $q->orWhere('nik_kajaga_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_kajaga_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //KAJAGA
        elseif(auth()->user()->id_level_user == 7){
            $reject_ts = TukarShift::where('reject',1)->where(function($q){
                $q->orWhere('nik_kajaga_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_kajaga_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //SATPAM
        elseif(auth()->user()->id_level_user == 8){
            $reject_ts = TukarShift::where('reject',1)->where(function($q){
                $q->orWhere('nik_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //SECURITY
        elseif(auth()->user()->id_level_user == 9){
            $reject_ts = TukarShift::where('reject',1)->where(function($q){
                $q->orWhere('nik_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //ADMIN
        elseif(auth()->user()->id_level_user == 11){
            $reject_ts = TukarShift::where('nik_pihak1', auth()->user()->karyawan->nik)->where('terbit',1)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }


        $hitung_data = count($data);
        $hitung_data_sudah = count($sudah_validasi);
        $hitung_data_reject = count($reject_ts);

        return view('absensi/list_tukar_shift',
            [
                'total_belum_valid' => $hitung_data,
                'total_sudah_valid' => $hitung_data_sudah,
                'total_reject' => $hitung_data_reject,
            ]);
    }

    public function data_tukar_shift_sudah_valid()
    {

        //SUPERADMIN
        if(auth()->user()->id_level_user == 1){
            $sudah_validasi = TukarShift::whereHas('karyawan.jabatan', function($q){
            })
            ->with('karyawan', function($q){
                $q->select('id_karyawan', 'nik_pihak1', 'id_jabatan', 'nama_lengkap')->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->whereNull('apv_pihak2')->orwhereNull('apv_kajaga_p1')->orwhereNull('apv_kajaga_p2');
            })
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //ADMIN APK
        elseif(auth()->user()->id_level_user == 12){
            $sudah_validasi = TukarShift::whereNull('apv_pihak2')->orwhereNull('apv_kajaga_p1')->orwhereNull('apv_kajaga_p2')->where('terbit',1)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //VP
        elseif(auth()->user()->id_level_user == 2){
            $sudah_validasi = TukarShift::whereNull('apv_pihak2')->orwhereNull('apv_kajaga_p1')->orwhereNull('apv_kajaga_p2')->where('terbit',1)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //AVP
        elseif(auth()->user()->id_level_user == 3){
            $sudah_validasi = TukarShift::whereNull('apv_pihak2')->orwhereNull('apv_kajaga_p1')->orwhereNull('apv_kajaga_p2')->where('terbit',1)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //SVP
        elseif(auth()->user()->id_level_user == 4){
            $sudah_validasi = TukarShift::where('terbit',1)->where(function($q){
                $q->orWhere('nik_kajaga_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_kajaga_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //FOREMAN
        elseif(auth()->user()->id_level_user == 6){
        $sudah_validasi = TukarShift::where('terbit',1)->where(function($q){
                $q->orWhere('nik_kajaga_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_kajaga_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //KAJAGA
        elseif(auth()->user()->id_level_user == 7){
            $sudah_validasi = TukarShift::where('terbit',1)->where(function($q){
                $q->orWhere('nik_kajaga_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_kajaga_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //SATPAM
        elseif(auth()->user()->id_level_user == 8){
            $sudah_validasi = TukarShift::where('terbit',1)->where(function($q){
                $q->orWhere('nik_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //SECURITY
        elseif(auth()->user()->id_level_user == 9){
            $sudah_validasi = TukarShift::where('terbit',1)->where(function($q){
                $q->orWhere('nik_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //ADMIN
        elseif(auth()->user()->id_level_user == 11){
            $sudah_validasi = TukarShift::where('nik_pihak1', auth()->user()->karyawan->nik)->where('terbit',1)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }

        if(request()->ajax()){
        return datatables()->of($sudah_validasi)
            ->addColumn('action', function($sudah_validasi){

                    $button =  '<a href="/detail_tukar_shift/'.$sudah_validasi->id_tukar_shift.'">
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

        return view('absensi/list_tukar_shift');
    }

    public function data_tukar_shift_reject()
    {

        //SUPERADMIN
        if(auth()->user()->id_level_user == 1){
            $reject_ts = TukarShift::whereHas('karyawan.jabatan', function($q){
            })
            ->with('karyawan', function($q){
                $q->select('id_karyawan', 'nik_pihak1', 'id_jabatan', 'nama_lengkap')->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->whereNull('apv_pihak2')->orwhereNull('apv_kajaga_p1')->orwhereNull('apv_kajaga_p2');
            })
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //ADMIN APK
        elseif(auth()->user()->id_level_user == 12){
            $reject_ts = TukarShift::where('reject',1)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //VP
        elseif(auth()->user()->id_level_user == 2){
            $reject_ts = TukarShift::where('reject',1)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //AVP
        elseif(auth()->user()->id_level_user == 3){
            $reject_ts = TukarShift::where('reject',1)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }
        //SVP
        elseif(auth()->user()->id_level_user == 4){
            $reject_ts = TukarShift::where('reject',1)->where(function($q){
                $q->orWhere('nik_kajaga_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_kajaga_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //FOREMAN
        elseif(auth()->user()->id_level_user == 6){
        $reject_ts = TukarShift::where('reject',1)->where(function($q){
                $q->orWhere('nik_kajaga_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_kajaga_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //KAJAGA
        elseif(auth()->user()->id_level_user == 7){
            $reject_ts = TukarShift::where('reject',1)->where(function($q){
                $q->orWhere('nik_kajaga_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_kajaga_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //SATPAM
        elseif(auth()->user()->id_level_user == 8){
            $reject_ts = TukarShift::where('reject',1)->where(function($q){
                $q->orWhere('nik_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //SECURITY
        elseif(auth()->user()->id_level_user == 9){
            $reject_ts = TukarShift::where('reject',1)->where(function($q){
                $q->orWhere('nik_pihak1', auth()->user()->karyawan->nik)
                ->orWhere('nik_pihak2', auth()->user()->karyawan->nik);
            })
            ->with('pihak_1')->with('pihak_2')
            ->orderBy('tgl_tukar', 'desc')
            ->get();
        }
        //ADMIN
        elseif(auth()->user()->id_level_user == 11){
            $reject_ts = TukarShift::where('nik_pihak1', auth()->user()->karyawan->nik)->where('terbit',1)->with('pihak_1')->with('pihak_2')->orderBy('tgl_tukar', 'desc')->get();
        }

        if(request()->ajax()){
        return datatables()->of($reject_ts)
            ->addColumn('action', function($reject_ts){

                    $button =  '<a href="/detail_tukar_shift/'.$reject_ts->id_tukar_shift.'">
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

        return view('absensi/list_tukar_shift');

    }

    public function detail_tukar_shift(Request $request)
    {
        $dt_tukar_shift = DB::table('tukar_shifts')
                    ->join('karyawans','karyawans.nik','=','tukar_shifts.nik_pihak1')
                    ->join('users', 'users.nik' ,'=', 'tukar_shifts.nik_pihak1')
                    ->select('tukar_shifts.id_tukar_shift','tukar_shifts.nik_pihak1','tukar_shifts.tgl_tukar','tukar_shifts.nik_pihak2','tukar_shifts.nik_kajaga_pihak1','tukar_shifts.nik_kajaga_pihak2','tukar_shifts.awal_jam_kerja','tukar_shifts.ubah_jam_kerja','tukar_shifts.apv_pihak2','tukar_shifts.apv_kajaga_p1','tukar_shifts.apv_kajaga_p2','tukar_shifts.reject','tukar_shifts.reject_by',
                    'karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan','users.foto',
                    'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                    'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif')
                    ->where('tukar_shifts.id_tukar_shift', '=', $request->id_tukar_shift)
                    ->first();

        $dt_yang_ditukar =  DB::table('users')->where('nik', $dt_tukar_shift->nik_pihak2)->first();

        $nama = Karyawan::where('nik',$dt_tukar_shift->nik)->with('jabatan.atasan_1','jabatan.atasan_2')->first();

        $apv_pihak2 = Karyawan::where('nik',$dt_tukar_shift->nik_pihak2)->with('apv_pihak2')->first();

        $apv_kajaga_p1 = Karyawan::where('nik',$dt_tukar_shift->nik_kajaga_pihak1)->with('apv_kajaga_p1')->first();

        $apv_kajaga_p2 = Karyawan::where('nik',$dt_tukar_shift->nik_kajaga_pihak2)->with('apv_kajaga_p2')->first();

        $nama_reject = TukarShift::where('id_tukar_shift',$request->id_tukar_shift)->with('reject')->first();


        return view('absensi/detail_tukar_shift',[
            'data_tukar_shift' => $dt_tukar_shift,
            'data_penerima' => $dt_yang_ditukar,
            'jab' => $nama,
            'nama_apv_pihak2' => $apv_pihak2,
            'nama_apv_kajaga_p1' => $apv_kajaga_p1,
            'nama_apv_kajaga_p2' => $apv_kajaga_p2,
            'rej' => $nama_reject
        ]);
    }



    public function form_lembur(Request $request, $nik){

        $nik = $request->nik;

        if($nik  == 'SA2021'){
            $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->distinct()
                ->orderBy('karyawans.id_karyawan', 'asc')
                ->get();
        }
        else{
            $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->distinct()
                ->where('karyawans.nik', $nik)
                ->orderBy('karyawans.id_karyawan', 'asc')
                ->get();
        }

        $bulan = Carbon::now()->isoFormat('M');

        $tanggal_awal = $this->getBetweenDate($bulan, true);
        $tanggal_akhir = $this->getBetweenDate($bulan, false);

        // if($tgl_lembur >= date('Y-m-d',strtotime("2020-12-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-01-25"))){
        //     // //Januari
        //     $tanggal_awal = "2020-12-26";
        //     $tanggal_akhir = "2021-01-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-01-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-02-25"))){
        //     // //Februari
        //     $tanggal_awal = "2020-01-26";
        //     $tanggal_akhir = "2021-02-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-02-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-03-25"))){
        //     // //Maret
        //     $tanggal_awal = "2021-02-26";
        //     $tanggal_akhir = "2021-03-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-03-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-04-25"))){
        //     // //April
        //     $tanggal_awal = "2021-03-26";
        //     $tanggal_akhir = "2021-04-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-04-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-05-25"))){
        //     // //Mei
        //     $tanggal_awal = "2021-04-26";
        //     $tanggal_akhir = "2021-05-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-05-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-06-25"))){
        //     // //Juni
        //     $tanggal_awal = "2021-05-26";
        //     $tanggal_akhir = "2021-06-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-06-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-07-25"))){
        //     // //Juli
        //     $tanggal_awal = "2021-06-26";
        //     $tanggal_akhir = "2021-07-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-07-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-08-25"))){
        //     // //Agustus
        //     $tanggal_awal = "2021-07-26";
        //     $tanggal_akhir = "2021-08-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-08-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-09-25"))){
        //     //September
        //     $tanggal_awal = "2021-08-26";
        //     $tanggal_akhir = "2021-09-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-09-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-10-25"))){
        //     // //Oktober
        //     $tanggal_awal = "2021-09-26";
        //     $tanggal_akhir = "2021-10-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-10-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-11-25"))){
        //     // //November
        //     $tanggal_awal = "2021-10-26";
        //     $tanggal_akhir = "2021-11-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-11-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-12-25"))){
        //     // //Desember
        //     $tanggal_awal = "2021-11-26";
        //     $tanggal_akhir = "2021-12-25";
        // }

        $total_lembur = DB::table('lemburs')
                ->whereRaw('tgl_lembur >= ? and tgl_lembur <= ?',[$tanggal_awal,$tanggal_akhir])
                ->where('nik',auth()->user()->nik)
                ->sum('total_jam_lembur');


        return view('absensi/form_lembur',
            [
                'data_kar' => $dt_kar,
                'total_lembur' => $total_lembur,
            ]);
    }

    function lembur_submit(Request $request)
    {
        $tgl = $request->tgl_lembur;
        $bulan = date("m", strtotime($tgl));
        $tgl_lembur = date("Y-m-d", strtotime($tgl));


        $dateFirst = $this->getBetweenDate($bulan, true);
        $dateEnd = $this->getBetweenDate($bulan, false);

        // if($tgl_lembur >= date('Y-m-d',strtotime("2021-12-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2022-01-25"))){
        //     // //Januari
        //     $tanggal_awal = "2020-12-26";
        //     $tanggal_akhir = "2021-01-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-01-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-02-25"))){
        //     // //Februari
        //     $tanggal_awal = "2020-01-26";
        //     $tanggal_akhir = "2021-02-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-02-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-03-25"))){
        //     // //Maret
        //     $tanggal_awal = "2021-02-26";
        //     $tanggal_akhir = "2021-03-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-03-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-04-25"))){
        //     // //April
        //     $tanggal_awal = "2021-03-26";
        //     $tanggal_akhir = "2021-04-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-04-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-05-25"))){
        //     // //Mei
        //     $tanggal_awal = "2021-04-26";
        //     $tanggal_akhir = "2021-05-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-05-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-06-25"))){
        //     // //Juni
        //     $tanggal_awal = "2021-05-26";
        //     $tanggal_akhir = "2021-06-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-06-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-07-25"))){
        //     // //Juli
        //     $tanggal_awal = "2021-06-26";
        //     $tanggal_akhir = "2021-07-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-07-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-08-25"))){
        //     // //Agustus
        //     $tanggal_awal = "2021-07-26";
        //     $tanggal_akhir = "2021-08-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-08-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-09-25"))){
        //     //September
        //     $tanggal_awal = "2021-08-26";
        //     $tanggal_akhir = "2021-09-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-09-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-10-25"))){
        //     // //Oktober
        //     $tanggal_awal = "2021-09-26";
        //     $tanggal_akhir = "2021-10-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-10-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-11-25"))){
        //     // //November
        //     $tanggal_awal = "2021-10-26";
        //     $tanggal_akhir = "2021-11-25";
        // }
        // elseif($tgl_lembur >= date('Y-m-d',strtotime("2021-11-26")) && $tgl_lembur <= date('Y-m-d',strtotime("2021-12-25"))){
        //     // //Desember
        //     $tanggal_awal = "2021-11-26";
        //     $tanggal_akhir = "2021-12-25";
        // }

        $cek_tanggal_presensi = DB::table('presensi_logs')->where('nik',$request->niknik)->where('tanggal',$tgl_lembur)->first();

        $nama_lengkap = $request->nama_lengkap;
        $tgl_lbr = date("d-m-Y", strtotime($tgl));

        $tanggal    = date("d", strtotime($tgl));
        $bulan      = date("m", strtotime($tgl));
        $tahun      = date("Y", strtotime($tgl));
        $id_regu    = auth()->user()->karyawan->id_regu;

        if($id_regu == '5'){
            $jadwal = JadwalShift::where('id_regu', $id_regu)
                    ->first();
        }
        else{
            $jadwal = JadwalShift::where('tanggal', $tanggal)
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->where('id_regu', $id_regu)
                    ->first();
        }

        $total_lembur = DB::table('lemburs')
                ->whereRaw('tgl_lembur >= ? and tgl_lembur <= ?',[$dateFirst,$dateEnd])
                ->where('nik',auth()->user()->nik)
                ->sum('total_jam_lembur');

        if($jadwal->action == "OFF"){
            Alert::error('Jadwal anda pada hari yang dipilih adalah OFF','Gagal Mengajukan SPL');
            return redirect('pengajuan');
        }
        elseif($total_lembur >= 20) {
            Alert::error('Jumlah SPL anda Bulan Ini Sudah Maksimum','Gagal Mengajukan SPL');
            return redirect('pengajuan');
        }
        elseif($total_lembur + $request->total_jam_lembur > 20) {
            $sisa_spl = 20 - $total_lembur;

            Alert::error('Jumlah Total SPL anda akan melebihi batas maksimal, sisa SPL anda bulan ini =', $sisa_spl );
            return redirect('pengajuan');
        }
        elseif($cek_tanggal_presensi === null){
            Alert::error('Jadwal yang anda pilih belum tersedia untuk saat ini','Gagal Mengajukan SPL');
            return redirect('pengajuan');
        }
        elseif(!is_null($cek_tanggal_presensi) && $total_lembur <= 20){

            $lembur                        = new Lembur();
            $lembur->nik                   = $request->niknik;
            $lembur->tgl_lembur            = $tgl_lembur;
            $lembur->total_jam_lembur      = $request->total_jam_lembur;
            $lembur->detail_lembur         = $request->detail;
            $lembur->validasi              = null;
            $lembur->mengetahui            = null;
            $lembur->terbit                = "0";
            $lembur->reject                = "0";
            $lembur->save();

            $notifikasi                      = new Notifikasi();
            $notifikasi->kategori_notifikasi = "Pengajuan";
            $notifikasi->judul_notifikasi    = "Pengajuan Lembur";
            $notifikasi->isi_notifikasi      = $nama_lengkap. " Mengajukan SPL pada tanggal " .$tgl_lbr;
            $notifikasi->user_id_penerima    = $request->user_id_penerima;
            $notifikasi->status              = 0;
            $notifikasi->save();

            return redirect('pengajuan')->with('success', 'Pengajuan Lembur Berhasil');
        }

    }

    public function form_lembur_khusus(Request $request, $nik){

        $nik = $request->nik;

        if($nik  == 'SA2021'){
            $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->distinct()
                ->orderBy('karyawans.id_karyawan', 'asc')
                ->get();
        }
        else{
            $dt_kar = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto','users.id_level_user')
                ->distinct()
                ->where('karyawans.nik', $nik)
                ->orderBy('karyawans.id_karyawan', 'asc')
                ->get();
        }

        return view('absensi/form_lembur_khusus',
            [
                'data_kar' => $dt_kar,
            ]);
    }

    function lembur_khusus_submit(Request $request)
    {
        $tgl = $request->tgl_lembur_khusus;
        $tgl_lembur_khusus = date("Y-m-d", strtotime($tgl));

        $id_zona = $request->nama_zona;

        $nama_lengkap = $request->nama_lengkap;
        $tgl_lbr_khs = date("d-m-Y", strtotime($tgl));

        if($id_zona == "I"){
            $zona = "PABRIK";
        }
        elseif($id_zona == "II"){
            $zona = "PABRIK";
        }
        elseif($id_zona == "III"){
            $zona = "PABRIK";
        }
        elseif($id_zona == "IV"){
            $zona = "PABRIK";
        }
        elseif($id_zona == "V"){
            $zona = "PABRIK";
        }
        elseif($id_zona == "TUKS"){
            $zona = "KAWASAN";
        }
        elseif($id_zona == "KAWASAN"){
            $zona = "KAWASAN";
        }
        elseif($id_zona == "PARKIR MASJID"){
            $zona = "KAWASAN";
        }
        elseif($id_zona == "PA GSARI"){
            $zona = "KAWASAN";
        }
        elseif($id_zona == "KANDANGAN"){
            $zona = "KAWASAN";
        }
        elseif($id_zona == "EWS"){
            $zona = "KAWASAN";
        }
        elseif($id_zona == "PA BABAT"){
            $zona = "KAWASAN";
        }
        elseif($id_zona == "BP LAMONGAN"){
            $zona = "KAWASAN";
        }
        elseif($id_zona == "GRAHA"){
            $zona = "OPS&MIN";
        }
        elseif($id_zona == "RING 1"){
            $zona = "OPS&MIN";
        }
        elseif($id_zona == "KANTOR DEPKAM"){
            $zona = "OPS&MIN";
        }

        $lembur_khusus                          = new LemburKhusus();
        $lembur_khusus->nik                     = $request->niknik;
        $lembur_khusus->tgl_lembur_khusus       = $tgl_lembur_khusus;
        $lembur_khusus->total_jam_lembur_khusus = $request->total_jam_lembur_khusus;
        $lembur_khusus->klasifikasi_zona        = $zona;
        $lembur_khusus->detail_lembur_khusus    = $request->detail;
        $lembur_khusus->validasi                = null;
        $lembur_khusus->mengetahui              = null;
        $lembur_khusus->mengetahui              = null;
        $lembur_khusus->terbit                  = "0";
        $lembur_khusus->reject                  = "0";
        $lembur_khusus->save();

        $notifikasi                             = new Notifikasi();
        $notifikasi->kategori_notifikasi        = "Pengajuan";
        $notifikasi->judul_notifikasi           = "Pengajuan Lembur Khusus";
        $notifikasi->isi_notifikasi             = $nama_lengkap. " Mengajukan Lembur Khusus pada tanggal " .$tgl_lbr_khs;
        $notifikasi->user_id_penerima           = $request->user_id_penerima;
        $notifikasi->status                     = 0;
        $notifikasi->save();

        return redirect('pengajuan')->with('success_lk', 'Tambah Form Lembur Khusus Berhasil');
    }

    public function list_lembur()
    {
        if(auth()->user()->id_level_user == 1){
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
        elseif(auth()->user()->id_level_user == 2){
            $data = Lembur::whereNull('validasi')->orwhereNull('mengetahui')->with('karyawan')->where('reject',0)->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 8){
            $data = Lembur::where('nik', auth()->user()->karyawan->nik)->where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 9){
            $data = Lembur::where('nik', auth()->user()->karyawan->nik )->where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 10){
            $data = Lembur::where('nik', auth()->user()->karyawan->nik )->where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 11){
            $data = Lembur::where('nik', auth()->user()->karyawan->nik )->where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
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
            ->where('reject',0)
            ->get();
        }

        if(request()->ajax()){
        return datatables()->of($data)

                ->addColumn('action', function($data){

                    if($data->karyawan->jabatan->direct_jab_atasan == auth()->user()->karyawan->id_jabatan)
                    {

                    $disable = !is_null($data->validasi) ? 'disabled' : '';
                    $url     = !is_null($data->validasi) ? "#" : "approve_lembur"."/".$data->id_lembur;
                    $tolak   = !is_null($data->validasi) ? "#" : "reject_lembur"."/".$data->id_lembur;

                    $button =  '<a href="/detail_lembur/'.$data->id_lembur.'">
                                    <button class="btn btn-primary" data-original-title="Detail">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </a>';
                    $button .= '<a href="'.$url.'">
                                    <button class="btn btn-primary" data-original-title="Approve" '.$disable.'>
                                        <i class="fa fa-check-square-o"></i>
                                    </button>
                                </a>';
                    $button .= '<a href="'.$tolak.'">
                                    <button class="btn btn-danger" data-original-title="Approve" '.$disable.'>
                                        <i class="fa fa-times"></i>
                                    </button>
                                </a>';

                    // $button  =  '<a href=/approve_tidak_masuk/'.$data->id_absensi.' class="btn btn-primary" data-original-title="Validasi">
                    //                 <i class="fa fa-check-square-o"</i>
                    //             </a>';
                    }

                    elseif($data->karyawan->jabatan->direct_jab_atasan_2 == auth()->user()->karyawan->id_jabatan){
                    $disable = is_null($data->validasi) ? 'disabled' : '';
                    $url     = is_null($data->validasi) ? "#" : "approve_lembur"."/".$data->id_lembur;
                    $tolak   = is_null($data->validasi) ? "#" : "reject_lembur"."/".$data->id_lembur;


                    $button =  '<a href="/detail_lembur/'.$data->id_lembur.'">
                                    <button class="btn btn-primary" data-original-title="Detail">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </a>';

                    $button .=  '<a href="'.$url.'">
                                    <button type="button" class="btn btn-primary" '.$disable.'>
                                        <i class="fa fa-check-square-o"></i>
                                    </button>
                                </a>';
                    $button .= '<a href="'.$tolak.'">
                                    <button class="btn btn-danger" data-original-title="Reject" '.$disable.'>
                                        <i class="fa fa-times"></i>
                                    </button>
                                </a>';
                    }

                    elseif(auth()->user()->id_level_user == 1){
                    $disable = !is_null($data->validasi) ? 'disabled' : '';
                    $url     = !is_null($data->validasi) ? "#" : "approve_lembur"."/".$data->id_lembur;
                    $tolak   = !is_null($data->validasi) ? "#" : "reject_lembur"."/".$data->id_lembur;


                    $button =  '<a href="/detail_lembur/'.$data->id_lembur.'">
                                    <button class="btn btn-primary" data-original-title="Detail">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </a>';

                    $button .=  '<a href="'.$url.'">
                                    <button type="button" class="btn btn-primary" '.$disable.'>
                                        <i class="fa fa-check-square-o"></i>
                                    </button>
                                </a>';
                    $button .= '<a href="'.$tolak.'">
                                    <button class="btn btn-danger" data-original-title="Reject" '.$disable.'>
                                        <i class="fa fa-times"></i>
                                    </button>
                                </a>';

                        if(!is_null($data->validasi)){
                        $button =  '<a href="/detail_absen/'.$data->id_lembur.'">
                                        <button class="btn btn-primary" data-original-title="Detail">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </a>';

                        $button .=  '<a href="/approve_lembur/'.$data->id_lembur.'">
                                        <button type="button" class="btn btn-primary">
                                            <i class="fa fa-check-square-o"></i>
                                        </button>
                                    </a>';

                        $button .= '<a href="/reject_lembur/'.$data->id_lembur.'">
                                    <button class="btn btn-danger" data-original-title="Reject" '.$disable.'>
                                        <i class="fa fa-times"></i>
                                    </button>
                                </a>';
                        }
                    }

                    else{
                    $button =  '<a href="/detail_lembur/'.$data->id_lembur.'">
                                    <button class="btn btn-primary" data-original-title="Detail">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </a>';
                    }
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

         if(auth()->user()->id_level_user == 1){
            $sudah_validasi = Lembur::where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 2){
            $sudah_validasi = Lembur::where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 8){
            $sudah_validasi = Lembur::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 9){
            $sudah_validasi = Lembur::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 10){
            $sudah_validasi = Lembur::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 11){
            $sudah_validasi = Lembur::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        else{
            $sudah_validasi = Lembur::whereHas('karyawan.jabatan', function($q){
                $q->where('direct_jab_atasan', auth()->user()->karyawan->id_jabatan)->orWhere('direct_jab_atasan_2', auth()->user()->karyawan->id_jabatan);
            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('terbit','=',1);
            })
            ->orderBy('tgl_lembur', 'desc')
            ->get();
        }




        if(auth()->user()->id_level_user == 1){
            $reject_lembur = Lembur::whereHas('karyawan.jabatan', function($q){

            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('reject','=',1);
            })
            ->orderBy('tgl_lembur', 'desc')
            ->get();
        }
        elseif(auth()->user()->id_level_user == 2){
            $reject_lembur = Lembur::where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 3){
            $reject_lembur = Lembur::where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 8){
            $reject_lembur = Lembur::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 9){
            $reject_lembur = Lembur::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 10){
            $reject_lembur = Lembur::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 11){
            $reject_lembur = Lembur::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        else{
            $reject_lembur = Lembur::whereHas('karyawan.jabatan', function($q){
                $q->where('direct_jab_atasan', auth()->user()->karyawan->id_jabatan)->orWhere('direct_jab_atasan_2', auth()->user()->karyawan->id_jabatan);
            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('reject','=',1);
            })
            ->orderBy('tgl_lembur', 'desc')
            ->get();
        }



        $hitung_data = count($data);
        $hitung_data_sudah = count($sudah_validasi);
        $hitung_data_reject = count($reject_lembur);

        return view('absensi/list_lembur',[
            'total_belum_valid' => $hitung_data,
            'total_sudah_valid' => $hitung_data_sudah,
            'total_reject' => $hitung_data_reject,
        ]);

    }

    public function data_lembur_sudah_valid()
    {
        if(auth()->user()->id_level_user == 1){
            $sudah_validasi = Lembur::where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 2){
            $sudah_validasi = Lembur::where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 8){
            $sudah_validasi = Lembur::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 9){
            $sudah_validasi = Lembur::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 10){
            $sudah_validasi = Lembur::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 11){
            $sudah_validasi = Lembur::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        else{
            $sudah_validasi = Lembur::whereHas('karyawan.jabatan', function($q){
                $q->where('direct_jab_atasan', auth()->user()->karyawan->id_jabatan)->orWhere('direct_jab_atasan_2', auth()->user()->karyawan->id_jabatan);
            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('terbit','=',1);
            })
            ->orderBy('tgl_lembur', 'desc')
            ->get();
        }

        if(request()->ajax()){
        return datatables()->of($sudah_validasi)
            ->addColumn('action', function($sudah_validasi){

                    $button =  '<a href="/detail_lembur/'.$sudah_validasi->id_lembur.'">
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
        return view('absensi/list_lembur');
    }

    public function data_lembur_reject()
    {

        if(auth()->user()->id_level_user == 1){
            $reject_lembur = Lembur::whereHas('karyawan.jabatan', function($q){

            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('reject','=',1);
            })
            ->orderBy('tgl_lembur', 'desc')
            ->get();
        }
        elseif(auth()->user()->id_level_user == 2){
            $reject_lembur = Lembur::where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 3){
            $reject_lembur = Lembur::where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 8){
            $reject_lembur = Lembur::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 9){
            $reject_lembur = Lembur::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 10){
            $reject_lembur = Lembur::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 11){
            $reject_lembur = Lembur::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        else{
            $reject_lembur = Lembur::whereHas('karyawan.jabatan', function($q){
                $q->where('direct_jab_atasan', auth()->user()->karyawan->id_jabatan)->orWhere('direct_jab_atasan_2', auth()->user()->karyawan->id_jabatan);
            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('reject','=',1);
            })
            ->orderBy('tgl_lembur', 'desc')
            ->get();
        }

        if(request()->ajax()){
        return datatables()->of($reject_lembur)
            ->addColumn('action', function($reject_lembur){

                    $button =  '<a href="/detail_lembur/'.$reject_lembur->id_lembur.'">
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

        return view('absensi/list_lembur');
    }

    public function detail_lembur(Request $request)
    {
        $dt_lembur = DB::table('lemburs')
                    ->join('karyawans','karyawans.nik','=','lemburs.nik')
                    ->join('users', 'users.nik' ,'=', 'lemburs.nik')
                    ->select('lemburs.id_lembur','lemburs.nik','lemburs.tgl_lembur','lemburs.total_jam_lembur','lemburs.detail_lembur','lemburs.validasi','lemburs.mengetahui','lemburs.reject','lemburs.reject_by',
                    'karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan','users.foto',
                    'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                    'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif')
                    ->where('lemburs.id_lembur', '=', $request->id_lembur)
                    ->first();

        $nama = Karyawan::where('nik',$dt_lembur->nik)->with('jabatan.atasan_1','jabatan.atasan_2')->first();

        $nama_1 = Karyawan::where('nik',$dt_lembur->validasi)->with('validasi_spl')->first();

        $nama_2 = Karyawan::where('nik',$dt_lembur->mengetahui)->with('mengetahui_spl')->first();

        $nama_reject = Lembur::where('id_lembur',$request->id_lembur)->with('reject')->first();

        return view('absensi/detail_lembur',[
            'data_lembur' => $dt_lembur,
            'jab' => $nama,
            'nama_validasi' => $nama_1,
            'nama_mengetahui' => $nama_2,
            'rej' => $nama_reject,
        ]);
    }

    public function list_lembur_khusus()
    {
        //SUPER ADMIN
        if(auth()->user()->id_level_user == 1){
            $data = LemburKhusus::whereHas('karyawan.jabatan', function($q){
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
        //VP
        elseif(auth()->user()->id_level_user == 2){
            $data = LemburKhusus::where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        //AVP OPSMIN
        elseif(auth()->user()->karyawan->id_jabatan == 2){
            $data = LemburKhusus::where('klasifikasi_zona','=','OPS&MIN')->whereNull('approve')->where('reject',0)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        //AVP KAWASAN
        elseif(auth()->user()->karyawan->id_jabatan == 3){
            $data = LemburKhusus::where('klasifikasi_zona','=','KAWASAN')->whereNull('approve')->where('reject',0)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        //AVP PABRIK
        elseif(auth()->user()->karyawan->id_jabatan == 4){
            $data = LemburKhusus::where('klasifikasi_zona','=','PABRIK')->whereNull('approve')->where('reject',0)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        //SATPAM
        elseif(auth()->user()->id_level_user == 8){
            $data = LemburKhusus::where('nik', auth()->user()->karyawan->nik)->where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        //SECURITY
        elseif(auth()->user()->id_level_user == 9){
            $data = LemburKhusus::where('nik', auth()->user()->karyawan->nik)->where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        //PAMTUP
        elseif(auth()->user()->id_level_user == 10){
            $data = LemburKhusus::where('nik', auth()->user()->karyawan->nik)->where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        //ADMIN
        elseif(auth()->user()->id_level_user == 11){
            $data = LemburKhusus::where('nik', auth()->user()->karyawan->nik)->where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }

        else{
            $data = LemburKhusus::whereHas('karyawan.jabatan', function($q){
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
            ->where('reject',0)
            ->get();
        }

        if(request()->ajax()){
        return datatables()->of($data)

                ->addColumn('action', function($data){

                    if($data->karyawan->jabatan->direct_jab_atasan == auth()->user()->karyawan->id_jabatan)
                    {

                        $disable = !is_null($data->validasi) ? 'disabled' : '';
                        $url     = !is_null($data->validasi) ? "#" : "approve_lembur_khusus"."/".$data->id_lembur_khusus;
                        $tolak   = !is_null($data->validasi) ? "#" : "reject_lembur_khusus"."/".$data->id_lembur_khusus;

                        $button =  '<a href="/detail_lembur_khusus/'.$data->id_lembur_khusus.'">
                                        <button class="btn btn-primary" data-original-title="Detail">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </a>';

                        $button .= '<a href="'.$url.'">
                                        <button class="btn btn-primary" data-original-title="Approve" '.$disable.'>
                                            <i class="fa fa-check-square-o"></i>
                                        </button>
                                    </a>';

                        $button .= '<a href="'.$tolak.'">
                                        <button class="btn btn-danger" data-original-title="Reject" '.$disable.'>
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </a>';

                        // $button  =  '<a href=/approve_tidak_masuk/'.$data->id_absensi.' class="btn btn-primary" data-original-title="Validasi">
                        //                 <i class="fa fa-check-square-o"</i>
                        //             </a>';
                    }

                    elseif($data->karyawan->jabatan->direct_jab_atasan_2 == auth()->user()->karyawan->id_jabatan)
                    {

                        if(!is_null($data->mengetahui)){
                            $button =  '<a href="/detail_lembur_khusus/'.$data->id_lembur_khusus.'">
                                            <button class="btn btn-primary" data-original-title="Detail">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </a>';
                        }
                        else{
                            $disable =is_null($data->validasi) ? 'disabled' : '';
                            $url     =is_null($data->validasi) ? "#" : "approve_lembur_khusus"."/".$data->id_lembur_khusus;
                            $tolak   =is_null($data->validasi) ? "#" : "reject_lembur_khusus"."/".$data->id_lembur_khusus;

                            $button =  '<a href="/detail_lembur_khusus/'.$data->id_lembur_khusus.'">
                                            <button class="btn btn-primary" data-original-title="Detail">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </a>';

                            $button .= '<a href="'.$url.'">
                                            <button class="btn btn-primary" data-original-title="Approve" '.$disable.'>
                                                <i class="fa fa-check-square-o"></i>
                                            </button>
                                        </a>';

                            $button .= '<a href="'.$tolak.'">
                                            <button class="btn btn-danger" data-original-title="Reject" '.$disable.'>
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </a>';
                        }

                    }

                    elseif(auth()->user()->id_level_user == 3)
                    {

                        $disable = is_null($data->mengetahui) ? 'disabled' : '';
                        $url     = is_null($data->mengetahui) ? "#" : "approve_lembur_khusus"."/".$data->id_lembur_khusus;
                        $tolak   = is_null($data->mengetahui) ? "#" : "reject_lembur_khusus"."/".$data->id_lembur_khusus;

                        $button =  '<a href="/detail_lembur_khusus/'.$data->id_lembur_khusus.'">
                                        <button class="btn btn-primary" data-original-title="Detail">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </a>';

                        $button .= '<a href="'.$url.'">
                                        <button class="btn btn-primary" data-original-title="Approve" '.$disable.'>
                                            <i class="fa fa-check-square-o"></i>
                                        </button>
                                    </a>';

                        $button .= '<a href="'.$tolak.'">
                                        <button class="btn btn-danger" data-original-title="Reject" '.$disable.'>
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </a>';

                    }

                    elseif(auth()->user()->id_level_user == 1){
                    $disable = !is_null($data->validasi) ? 'disabled' : '';
                    $url     = !is_null($data->validasi) ? "#" : "approve_lembur_khusus"."/".$data->id_lembur_khusus;
                    $tolak   = is_null($data->mengetahui) ? "#" : "reject_lembur_khusus"."/".$data->id_lembur_khusus;

                    $button =  '<a href="/detail_lembur_khusus/'.$data->id_lembur_khusus.'">
                                    <button class="btn btn-primary" data-original-title="Detail">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </a>';

                    $button .=  '<a href="'.$url.'">
                                    <button type="button" class="btn btn-primary" '.$disable.'>
                                        <i class="fa fa-check-square-o"></i>
                                    </button>
                                </a>';

                    $button .= '<a href="'.$tolak.'">
                                    <button class="btn btn-danger" data-original-title="Reject" '.$disable.'>
                                        <i class="fa fa-times"></i>
                                    </button>
                                </a>';

                        if(!is_null($data->validasi)){
                        $button =  '<a href="/detail_lembur_khusus/'.$data->id_lembur_khusus.'">
                                        <button class="btn btn-primary" data-original-title="Detail">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </a>';

                        $button .=  '<a href="/approve_lembur_khusus/'.$data->id_lembur_khusus.'">
                                        <button type="button" class="btn btn-primary">
                                            <i class="fa fa-check-square-o"></i>
                                        </button>
                                    </a>';

                        $button .=  '<a href="/reject_lembur_khusus/'.$data->id_lembur_khusus.'">
                                        <button class="btn btn-danger" data-original-title="Reject" '.$disable.'>
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </a>';
                        }
                    }

                    else{
                    $button =  '<a href="/detail_lembur_khusus/'.$data->id_lembur_khusus.'">
                                    <button class="btn btn-primary" data-original-title="Detail">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </a>';

                    }
                    return $button;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        if(auth()->user()->id_level_user == 1){
            $sudah_validasi = LemburKhusus::whereHas('karyawan.jabatan', function($q){
            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('terbit','=',1);
            })
            ->orderBy('tgl_lembur_khusus', 'desc')
            ->get();
        }
        elseif(auth()->user()->id_level_user == 2){
            $sudah_validasi = LemburKhusus::where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 2){
            $sudah_validasi = LemburKhusus::where('terbit','=',1)->where('klasifikasi_zona','=',"OPS&MIN")->whereNotNull('approve')->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 3){
            $sudah_validasi = LemburKhusus::where('terbit','=',1)->where('klasifikasi_zona','=',"KAWASAN")->whereNotNull('approve')->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 4){
            $sudah_validasi = LemburKhusus::where('terbit','=',1)->where('klasifikasi_zona','=',"PABRIK")->whereNotNull('approve')->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 8){
            $sudah_validasi = LemburKhusus::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 9){
            $sudah_validasi = LemburKhusus::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 10){
            $sudah_validasi = LemburKhusus::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 11){
            $sudah_validasi = LemburKhusus::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        else{
            $sudah_validasi = LemburKhusus::whereHas('karyawan.jabatan', function($q){
                $q->where('direct_jab_atasan', auth()->user()->karyawan->id_jabatan)->orWhere('direct_jab_atasan_2', auth()->user()->karyawan->id_jabatan);
            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('terbit','=',1);
            })
            ->orderBy('tgl_lembur_khusus', 'desc')
            ->get();
        }


        if(auth()->user()->id_level_user == 1){
            $reject_lembur_khusus = LemburKhusus::whereHas('karyawan.jabatan', function($q){

            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('reject','=',1);
            })
            ->orderBy('tgl_lembur_khusus', 'desc')
            ->get();
        }
        elseif(auth()->user()->id_level_user == 2){
            $reject_lembur_khusus = LemburKhusus::where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 3){
            $reject_lembur_khusus = LemburKhusus::where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 8){
            $reject_lembur_khusus = LemburKhusus::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 9){
            $reject_lembur_khusus = LemburKhusus::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 10){
            $reject_lembur_khusus = LemburKhusus::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 11){
            $reject_lembur_khusus = LemburKhusus::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }

        else{
            $reject_lembur_khusus = LemburKhusus::whereHas('karyawan.jabatan', function($q){
                $q->where('direct_jab_atasan', auth()->user()->karyawan->id_jabatan)->orWhere('direct_jab_atasan_2', auth()->user()->karyawan->id_jabatan);
            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('reject','=',1);
            })
            ->orderBy('tgl_lembur_khusus', 'desc')
            ->get();
        }



        $hitung_data = count($data);
        $hitung_data_sudah = count($sudah_validasi);
        $hitung_data_reject = count($reject_lembur_khusus);

        return view('absensi/list_lembur_khusus',[
            'total_belum_valid' => $hitung_data,
            'total_sudah_valid' => $hitung_data_sudah,
            'total_reject' => $hitung_data_reject,
        ]);
    }

    public function data_lembur_khusus_sudah_valid()
    {

        if(auth()->user()->id_level_user == 1){
            $sudah_validasi = LemburKhusus::whereHas('karyawan.jabatan', function($q){
            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('terbit','=',1);
            })
            ->orderBy('tgl_lembur_khusus', 'desc')
            ->get();
        }
        elseif(auth()->user()->id_level_user == 2){
            $sudah_validasi = LemburKhusus::where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 2){
            $sudah_validasi = LemburKhusus::where('terbit','=',1)->where('klasifikasi_zona','=',"OPS&MIN")->whereNotNull('approve')->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 3){
            $sudah_validasi = LemburKhusus::where('terbit','=',1)->where('klasifikasi_zona','=',"KAWASAN")->whereNotNull('approve')->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->karyawan->id_jabatan == 4){
            $sudah_validasi = LemburKhusus::where('terbit','=',1)->where('klasifikasi_zona','=',"PABRIK")->whereNotNull('approve')->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 8){
            $sudah_validasi = LemburKhusus::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 9){
            $sudah_validasi = LemburKhusus::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 10){
            $sudah_validasi = LemburKhusus::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 11){
            $sudah_validasi = LemburKhusus::where('nik', auth()->user()->karyawan->nik )->where('terbit','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        else{
            $sudah_validasi = LemburKhusus::whereHas('karyawan.jabatan', function($q){
                $q->where('direct_jab_atasan', auth()->user()->karyawan->id_jabatan)->orWhere('direct_jab_atasan_2', auth()->user()->karyawan->id_jabatan);
            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('terbit','=',1);
            })
            ->orderBy('tgl_lembur_khusus', 'desc')
            ->get();
        }

        if(request()->ajax()){
        return datatables()->of($sudah_validasi)
            ->addColumn('action', function($sudah_validasi){

                    $button =  '<a href="/detail_lembur_khusus/'.$sudah_validasi->id_lembur_khusus.'">
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

        return view('absensi/list_lembur_khusus');
    }

    public function data_lembur_khusus_reject()
    {

        if(auth()->user()->id_level_user == 1){
            $reject_lembur_khusus = LemburKhusus::whereHas('karyawan.jabatan', function($q){

            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('reject','=',1);
            })
            ->orderBy('tgl_lembur_khusus', 'desc')
            ->get();
        }
        elseif(auth()->user()->id_level_user == 2){
            $reject_lembur_khusus = LemburKhusus::where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 3){
            $reject_lembur_khusus = LemburKhusus::where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 8){
            $reject_lembur_khusus = LemburKhusus::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 9){
            $reject_lembur_khusus = LemburKhusus::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 10){
            $reject_lembur_khusus = LemburKhusus::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        elseif(auth()->user()->id_level_user == 11){
            $reject_lembur_khusus = LemburKhusus::where('nik', auth()->user()->karyawan->nik )->where('reject','=',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }

        else{
            $reject_lembur_khusus = LemburKhusus::whereHas('karyawan.jabatan', function($q){
                $q->where('direct_jab_atasan', auth()->user()->karyawan->id_jabatan)->orWhere('direct_jab_atasan_2', auth()->user()->karyawan->id_jabatan);
            })
                ->with('karyawan', function($q){
                    $q->select('id_karyawan', 'nik', 'id_jabatan', 'nama_lengkap')
                ->with('jabatan', function($q){
                    $q->select('id_jabatan','direct_jab_atasan', 'direct_jab_atasan_2');
                });
            })
            ->where(function($q){
                $q->where('reject','=',1);
            })
            ->orderBy('tgl_lembur_khusus', 'desc')
            ->get();
        }

        if(request()->ajax()){
        return datatables()->of($reject_lembur_khusus)
            ->addColumn('action', function($reject_lembur_khusus){

                    $button =  '<a href="/detail_lembur_khusus/'.$reject_lembur_khusus->id_lembur_khusus.'">
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

        return view('absensi/list_lembur_khusus');
    }

    public function detail_lembur_khusus(Request $request)
    {

        $dt_lembur_khusus = DB::table('lembur_khususes')
                    ->join('karyawans','karyawans.nik','=','lembur_khususes.nik')
                    ->join('users', 'users.nik' ,'=', 'lembur_khususes.nik')
                    ->select('lembur_khususes.id_lembur_khusus','lembur_khususes.nik','lembur_khususes.tgl_lembur_khusus','lembur_khususes.total_jam_lembur_khusus','lembur_khususes.klasifikasi_zona','lembur_khususes.detail_lembur_khusus','lembur_khususes.validasi','lembur_khususes.mengetahui','lembur_khususes.approve','lembur_khususes.reject','lembur_khususes.reject_by',
                    'karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan','users.foto',
                    'karyawans.pt','karyawans.no_kib','karyawans.tgl_lahir','karyawans.no_ktp','karyawans.alamat','karyawans.rtrw','karyawans.desa','karyawans.kecamatan','karyawans.kabupaten',
                    'karyawans.no_hp','karyawans.no_ktp','karyawans.kompetensi_gada','karyawans.no_reg','karyawans.no_kta','karyawans.no_ijazah','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif')
                    ->where('lembur_khususes.id_lembur_khusus', '=', $request->id_lembur_khusus)
                    ->first();


        $nama = Karyawan::where('nik',$dt_lembur_khusus->nik)->with('jabatan.atasan_1','jabatan.atasan_2')->first();

        $nama_1 = Karyawan::where('nik',$dt_lembur_khusus->validasi)->with('validasi')->first();

        $nama_2 = Karyawan::where('nik',$dt_lembur_khusus->mengetahui)->with('mengetahui')->first();

        $nama_appv = Karyawan::where('nik',$dt_lembur_khusus->approve)->with('approve')->first();

        $nama_reject = LemburKhusus::where('id_lembur_khusus',$request->id_lembur_khusus)->with('reject')->first();

        return view('absensi/detail_lembur_khusus',[
            'data_lembur_khusus' => $dt_lembur_khusus,
            'jab' => $nama,
            'nama_validasi' => $nama_1,
            'nama_mengetahui' => $nama_2,
            'nama_app' => $nama_appv,
            'rej' => $nama_reject,
        ]);
    }

    public function data_jadwal(){

        $pattern = ['S','S','OFF','M','M','OFF','P','P','P','S','S','OFF','M','M','M','OFF','P','P','S','S','OFF','OFF','M','M','OFF','P','P','S'];

        $regu_a = $pattern;
        $regu_b = array_merge(array_slice($pattern,21), array_slice($pattern,0,21));
        $regu_c = array_merge(array_slice($pattern,7), array_slice($pattern,0,7));
        $regu_d = array_merge(array_slice($pattern,14), array_slice($pattern,0,14));

        $en = Carbon::now()->locale('en_US');

        $tanggal = strtotime(Carbon::now());

        // number day of week
        $dow = $en->isoFormat('d'); //5

        $wom = $en->isoFormat('w'); //1

        if($wom > 4){
            if($wom % 4 == 0)
            $wom = 4;
            else
            $wom = $wom % 4;
        }

        $max_scope = $wom * 7;
        $min_scope = $max_scope - 7;

        $result['a'] = array_slice($regu_a,$min_scope, $max_scope)[$dow];
        $result['b'] = array_slice($regu_b,$min_scope, $max_scope)[$dow];
        $result['c'] = array_slice($regu_c,$min_scope, $max_scope)[$dow];
        $result['d'] = array_slice($regu_d,$min_scope, $max_scope)[$dow];

        $regu = ['A','B','C','D'];
        $id_regu = ['1','2','3','4'];

        foreach($result as $value){
            $action[]=$value;
        }
        for($i = 0; $i < count($regu);$i++){
            $getid_regu = $id_regu[$i];
            $getregu = $regu[$i];
            $getaction = $action[$i];

            if($getaction  == 'OFF'){
                $masuk = 'OFF';
                $keluar = 'OFF';
            }elseif($getaction == 'P'){
                $masuk = '06.00';
                $keluar = '14.00';
            }elseif($getaction == 'S'){
                $masuk = '14.00';
                $keluar = '21.00';
            }elseif($getaction = 'M'){
                $masuk = '21.00';
                $keluar = '06.00';
            }

            $getdata []= array_merge([
                'id_regu' => $getid_regu,
                'regu' => $getregu,
                'action' => $getaction,
                'tanggal' => date('Y-m-d', $tanggal),
                'bulan' => date('F', $tanggal),
                'tahun' => date('Y', $tanggal),
                'pattern_number' => $wom,
                'jam_masuk' => $masuk,
                'jam_keluar' => $keluar
            ]);
        }


        $jadwal = DB::table('jadwal_shifts')
                ->select('id_jadwal', 'tanggal', 'bulan', 'tahun', 'id_regu', 'jam_masuk','jam_keluar', 'action')
                ->get();

        if(request()->ajax()){
            return datatables()->of($jadwal)
                        ->addColumn('aksi', function($data){

                            $button =  '<a href=/data-project/'.$data->id_jadwal.' data-toggle="tooltip" class="btn btn-inverse-info btn-icon" >
                                        <i class="mdi mdi-information"></i>
                                        </a>';
                            $button .= '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id_jadwal.'" data-original-title="Edit" class="edit btn btn-inverse-success btn-sm btn-icon edit-post">
                                        <i class="mdi mdi-tooltip-edit"></i>
                                        </a>';
                            // $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-inverse-danger btn-sm btn-icon">
                            //             <i class="mdi mdi-eraser"></i>
                            //            </button>';

                            // $button = '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->customer_id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-post"><i class="far fa-edit"></i> Edit</a>';


                            // $button .= '<button type="button" name="delete" id="'.$data->customer_id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>';
                            return $button;
                        })
                        ->rawColumns(['aksi'])
                        ->addIndexColumn()
                        ->make(true);
        }

        $bulan = ["J","F","M","A","M","J","J","A","S","O","N","D"];


        return view('absensi/data_jadwal',
            [
                'data_jadwal'     => $jadwal,
                'getdata'         => $getdata,
                'A'               => $regu_a,
                'B'               => $regu_b,
                'C'               => $regu_c,
                'D'               => $regu_d,
                'bulan'           => $bulan,
            ]);
    }

    public function data_jadwal_karyawan(Request $request)
    {
        $data_karyawan = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.tgl_lahir','karyawans.alamat','karyawans.no_hp','karyawans.no_ktp','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto')
                ->where('karyawans.id_regu' ,'=' , $request->id_regu)
                ->get();

        if(request()->ajax()){
            return datatables()->of($data_karyawan)
            ->make(true);
        }

        return view('absensi/jadwal_regu',
            [
                'data_karyawan' => $data_karyawan,
            ]);
    }

    // public function laporan_presensi(){
    //     $bulan = DB::table('bulans')->get();

    //     $dt_presensi = DB::table('presensi_logs')->get();

    //     $dt_akun= DB::table('users')
    //                     ->join('level_users', 'level_users.id_level_user', '=', 'users.id_level_user')
    //                     ->join('departemens','departemens.id_departemen','=', 'users.id_departemen')
    //                     ->select('users.id_user','users.nik','users.password','users.email','users.id_level_user','level_users.nama_level','users.foto','departemens.nama_departemen','users.id_departemen')
    //                     ->get();

    //     $data_karyawan = DB::table('karyawans')
    //             ->join('users', 'users.nik' ,'=', 'karyawans.nik')
    //             ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
    //             ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
    //             ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
    //             ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
    //             'karyawans.tgl_lahir','karyawans.alamat','karyawans.no_hp','karyawans.no_ktp','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto')
    //             ->get();

    //     if(request()->ajax()){
    //     return datatables()->of($data_karyawan)
    //             ->addColumn('action', function($data){

    //                 $button =  '<a href=/absensi_karyawan_print/'.$data->nik.'>
    //                             <button class="btn btn-primary" data-original-title="Detail">
    //                                 <i class="fa fa-print"></i>
    //                             </button>
    //                             </a>';

    //                 // $button =  '<a href=/absensi_karyawan_print/>
    //                 //             <button class="btn btn-primary" data-original-title="Detail">
    //                 //                 <i class="fa fa-eye"></i>
    //                 //             </button>
    //                 //             </a>';
    //                 // $button .=  '<a href=/absensi_karyawan_print/'.$data->id_karyawan.'>
    //                 //             <button class="btn btn-primary" data-original-title="Detail">
    //                 //                 <i class="fa fa-eye"></i>
    //                 //             </button>
    //                 //             </a>';

    //                 return $button;
    //             })
    //             ->rawColumns(['action'])
    //             ->addIndexColumn()
    //             ->make(true);
    //     }


    //     $dt_jabatan = DB::table('jabatans')->get();
    //     $dt_zona = DB::table('zonas')->get();
    //     $dt_regu = DB::table('regus')->get();
    //     $dt_level = DB::table('level_users')->get();
    //     $dt_departemen = DB::table('departemens')->get();

    //     return view('absensi/laporan_presensi',
    //         [
    //             'data_presensi'     => $dt_presensi,
    //             'data_user'         => $dt_akun,
    //             'data_kar'          => $data_karyawan,
    //             'data_departemen'   => $dt_departemen,
    //             'jabatan'           => $dt_jabatan,
    //             'zona'              => $dt_zona,
    //             'regu'              => $dt_regu,
    //             'level'             => $dt_level,
    //             'data_bulan'        => $bulan
    //         ]);
    // }

    public function laporan_presensi_filter(){



        $dt_presensi = DB::table('presensi_logs')->get();

        $dt_akun= DB::table('users')
                        ->join('level_users', 'level_users.id_level_user', '=', 'users.id_level_user')
                        ->join('departemens','departemens.id_departemen','=', 'users.id_departemen')
                        ->select('users.id_user','users.nik','users.password','users.email','users.id_level_user','level_users.nama_level','users.foto','departemens.nama_departemen','users.id_departemen')
                        ->get();

        $data_karyawan = DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.tgl_lahir','karyawans.alamat','karyawans.no_hp','karyawans.no_ktp','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto')
                ->get();

        if(request()->ajax()){
        return datatables()->of($data_karyawan)
                ->addColumn('action', function($data){

                    $button =  '<a href=/absensi_karyawan_print/'.$data->nik.'>
                                <button class="btn btn-primary" data-original-title="Detail">
                                    <i class="fa fa-print"></i>
                                </button>
                                </a>';

                    // $button =  '<a href=/absensi_karyawan_print/>
                    //             <button class="btn btn-primary" data-original-title="Detail">
                    //                 <i class="fa fa-eye"></i>
                    //             </button>
                    //             </a>';
                    // $button .=  '<a href=/absensi_karyawan_print/'.$data->id_karyawan.'>
                    //             <button class="btn btn-primary" data-original-title="Detail">
                    //                 <i class="fa fa-eye"></i>
                    //             </button>
                    //             </a>';

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

        return view('absensi/laporan_presensi_filter',
            [
                'data_presensi'     => $dt_presensi,
                'data_user'         => $dt_akun,
                'data_kar'          => $data_karyawan,
                'data_departemen'   => $dt_departemen,
                'jabatan'           => $dt_jabatan,
                'zona'              => $dt_zona,
                'regu'              => $dt_regu,
                'level'             => $dt_level,
            ]);
    }

    // public function laporan_rekap(Request $request){

    //     $data_karyawan = Karyawan::with([
    //                 'user:nik,email,foto',
    //                 'regu:id_regu,nama_regu',
    //                 'zona:id_zona,nama_zona',
    //                 'jabatan:id_jabatan,nama_jabatan,direct_jab_atasan,direct_jab_atasan_2',
    //                 ])
    //                 ->where('pt','=','AJG')->orWhere('pt','=','FJM')
    //                 ->orderBy('id_zona','asc')->orderBy('id_regu', 'asc')
    //                 ->get();
    //     return $dateFirst = $this->getBetweenDate($request->id_bulan, true);
    //     $dateEnd = $this->getBetweenDate($request->id_bulan, false);


    //     $bulan = DB::table('bulans')->where('id_bulan',$request->id_bulan)->first();

    //     $presensi = DB::table('presensi_logs')
    //             ->join('users','users.nik','=','presensi_logs.nik')
    //             ->join('karyawans','karyawans.nik','=','presensi_logs.nik')
    //             ->leftJoin('lemburs','lemburs.id_lembur','=','presensi_logs.id_lembur')
    //             ->leftJoin('lembur_khususes','lembur_khususes.id_lembur_khusus','=','presensi_logs.id_lembur_khusus')
    //             ->select('karyawans.pt','karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan',
    //             'karyawans.tgl_lahir','karyawans.alamat','karyawans.no_hp','karyawans.no_ktp','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto',
    //             'presensi_logs.id_presensi','presensi_logs.nik', 'presensi_logs.tanggal', 'presensi_logs.jadwal_kerja', 'presensi_logs.check_in','presensi_logs.check_out', 'presensi_logs.detail','presensi_logs.id_lembur','presensi_logs.id_lembur_khusus','presensi_logs.id_absensi',
    //             'lemburs.total_jam_lembur','lembur_khususes.total_jam_lembur_khusus','lemburs.detail_lembur','lembur_khususes.detail_lembur_khusus')
    //             ->where('presensi_logs.nik', auth()->user()->karyawan->nik)
    //             ->whereRaw('presensi_logs.tanggal >= ? and presensi_logs.tanggal <= ?',[$dateFirst,$dateEnd])
    //             ->orderBy('presensi_logs.tanggal', 'asc')
    //             ->get();

    //     $datetime1 = new DateTime($dateFirst);
    //     $datetime2 = new DateTime($dateEnd);
    //     $interval = $datetime1->diff($datetime2);
    //     $total_hari = $interval->format('%a');

    //     $cuti = DB::table('absensi_logs')
    //             ->where('nik', auth()->user()->karyawan->nik)
    //             ->where('tipe_absen','=','Cuti')
    //             ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$dateFirst,$dateEnd])
    //             ->count();
    //     $dispensasi = DB::table('absensi_logs')
    //             ->where('nik', auth()->user()->karyawan->nik)
    //             ->where('tipe_absen','=','Dispensasi')
    //             ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$dateFirst,$dateEnd])
    //             ->count();
    //     $sakit = DB::table('absensi_logs')
    //             ->where('nik', auth()->user()->karyawan->nik)
    //             ->where('tipe_absen','=','Sakit')
    //             ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$dateFirst,$dateEnd])
    //             ->count();
    //     $ijin = DB::table('absensi_logs')
    //             ->where('nik', auth()->user()->karyawan->nik)
    //             ->where('tipe_absen','=','Ijin')
    //             ->where('terbit','=',1)
    //             ->whereRaw('tgl_absen >= ? and tgl_absen <= ?',[$dateFirst,$dateEnd])
    //             ->count();

    //     $off = DB::table('presensi_logs')
    //             ->where('nik', auth()->user()->karyawan->nik)
    //             ->where('jadwal_kerja','=','OFF')
    //             ->whereRaw('tanggal >= ? and tanggal <= ?',[$dateFirst,$dateEnd])
    //             ->count();

    //     $total_absen = DB::table('presensi_logs')
    //             ->where('nik', auth()->user()->karyawan->nik)
    //             ->whereRaw('tanggal>= ? and tanggal <= ?',[$dateFirst,$dateEnd])
    //             ->count('detail');

    //     $hadir = DB::table('presensi_logs')
    //             ->where('nik', auth()->user()->karyawan->nik)
    //             ->whereRaw('tanggal>= ? and tanggal <= ?',[$dateFirst,$dateEnd])
    //             ->count('lat');

    //     $mangkir = ($total_hari+1)-($off+$total_absen+$hadir);

    //     return view('absensi/laporan_rekap_print',
    //         [
    //             'data_karyawan'=>$data_karyawan
    //         ]);
    // }

    public function absensi_karyawan_print(Request $request)
    {
        $dt_kar= DB::table('karyawans')
                ->join('users', 'users.nik' ,'=', 'karyawans.nik')
                ->join('zonas', 'zonas.id_zona', '=', 'karyawans.id_zona')
                ->join('regus', 'regus.id_regu', '=', 'karyawans.id_regu')
                ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
                ->select('karyawans.pt','karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona','zonas.nama_zona', 'karyawans.id_regu','regus.nama_regu','jabatans.nama_jabatan','karyawans.id_jabatan',
                'karyawans.tgl_lahir','karyawans.alamat','karyawans.no_hp','karyawans.no_ktp','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto')
                ->where('karyawans.nik','=', $request->nik)
                ->get();

        $presensi = DB::table('presensi_logs')
                ->join('users','users.nik','=','presensi_logs.nik')
                ->join('karyawans','karyawans.nik','=','presensi_logs.nik')
                // ->join('zonas','zonas.id_zona','=','presensi_logs.id_zona')
                // ->join('regus','regus.id_regu','=','presensi_logs.id_regu')
                // ->join('jabatans','jabatans.id_jabatan','=','presensi_logs.id_jabatan')
                // ->join('lemburs','lemburs.id_lembur','=','presensi_logs.id_lembur')
                // ->join('absensi_logs','absensi_logs.id_absensi','=','presensi_logs.id_absensi')
                ->select('karyawans.pt','karyawans.id_karyawan','karyawans.nik', 'karyawans.nama_lengkap','karyawans.id_zona', 'karyawans.id_regu','karyawans.id_jabatan',
                'karyawans.tgl_lahir','karyawans.alamat','karyawans.no_hp','karyawans.no_ktp','karyawans.tgl_jatuhtempo_gada','karyawans.status_aktif','users.foto',
                'presensi_logs.id_presensi','presensi_logs.nik', 'presensi_logs.tanggal', 'presensi_logs.jadwal_kerja', 'presensi_logs.check_in','presensi_logs.check_out', 'presensi_logs.detail')
                ->where('presensi_logs.nik','=', $request->nik)
                ->get();


        return view('absensi/absensi_karyawan_print',
            [
                'data_karyawan' => $dt_kar,
                'data_absen' => $presensi
            ]);
    }

    public function dokumen(){
        return view('absensi/laporan_rekap_print',
            [

            ]);
    }

    public function approve_tidak_masuk($id)
    {
        $cek_data_tahap_1 = DB::table('absensi_logs')->where('id_absensi',$id)->first();

        $dt_abs = DB::table('absensi_logs')
                    ->join('karyawans','karyawans.nik','=','absensi_logs.nik')
                    ->where('absensi_logs.id_absensi',$id)->first();

        $jabatan = DB::table('karyawans')
                    ->join('jabatans','jabatans.id_jabatan' , '=' , 'karyawans.id_jabatan')
                    ->where('karyawans.nik',$dt_abs->nik)
                    ->first();

        //NOTIF KE TAHAP 2
        $dt_kar_penerima = DB::table('karyawans')
                    ->where('id_jabatan', $jabatan->direct_jab_atasan_2)
                    ->first();
        $dt_user_penerima = DB::table('users')
                    ->where('nik', $dt_kar_penerima->nik)
                    ->first();

        //NOTIF KE YANG MENGAJUKAN
        $tipe_absen = DB::table('absensi_logs')->where('id_absensi',$id)->first();

        $data_karyawan = DB::table('karyawans')->where('nik',$tipe_absen->nik)->first();

        $user_yang_mengajukan_tidak_masuk = DB::table('users')->where('nik', $tipe_absen->nik)->first();


        $data_tidak_masuk = AbsensiLog::where('id_absensi',$id)->first();

        $bulan = ["", "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        $tgl = $data_tidak_masuk->tgl_absen;
        $exp = explode(" ", $tgl);
        $bln_int = array_search($exp[1], $bulan);
        $bln_int = str_pad($bln_int, 2, '0', STR_PAD_LEFT);
        $tgl_int = str_pad($exp[0], 2, '0', STR_PAD_LEFT);
        $fixed_tgl = $exp[2]."-".$bln_int."-".$tgl_int;
        $tgl_appv = date("d-m-Y", strtotime($tgl));

        //SUPER ADMIN
        if(auth()->user()->id_level_user == 1){
            $cek_data = AbsensiLog::where('id_absensi',$id)->select('validasi')->first();

            //SUPER ADMIN TAHAP 1
            if($cek_data->validasi === null)
            {
                AbsensiLog::where('id_absensi',$id)->update([
                    'validasi' => auth()->user()->nik,
                ]);

                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Pengajuan";
                $notifikasi->judul_notifikasi    = "Pengajuan Tidak Masuk";
                $notifikasi->isi_notifikasi      = $dt_abs->nama_lengkap. " Mengajukan Tidak Masuk Kerja pada tanggal " .$dt_abs->tgl_absen;
                $notifikasi->user_id_penerima    = $dt_user_penerima->id_user;
                $notifikasi->status              = 0;
                $notifikasi->save();
            }
            // SUPER ADMIN TAHAP 2
            else
            {
                AbsensiLog::where('id_absensi',$id)->update([
                    'mengetahui' => auth()->user()->nik,
                    'terbit' => 1,
                ]);

                if($tipe_absen->tipe_absen == "Cuti"){

                    $hasil_pengurangan_cuti = $data_karyawan->sisa_cuti - 1;

                    Karyawan::where('nik',$tipe_absen->nik)->update([
                        'sisa_cuti' => $hasil_pengurangan_cuti,
                    ]);
                }

                $hadir                          = new PresensiLog();
                $hadir->id_absensi              = $data_tidak_masuk->id_absensi;
                $hadir->nik                     = $data_tidak_masuk->nik;
                $hadir->tanggal                 = $fixed_tgl;
                $hadir->jadwal_kerja            = $data_tidak_masuk->tipe_absen;
                $hadir->lat                     = null;
                $hadir->lng                     = null;
                $hadir->id_zona                 = null;
                $hadir->id_regu                 = null;
                $hadir->id_jabatan              = null;
                $hadir->check_in                = null;
                $hadir->check_out               = null;
                $hadir->status                  = "off_duty";
                $hadir->detail                  = $data_tidak_masuk->detail;
                $hadir->save();

                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Approve";
                $notifikasi->judul_notifikasi    = "Pengajuan Tidak Masuk Disetujui";
                $notifikasi->isi_notifikasi      = "Pengajuan tidak masuk kerja pada tanggal " .$tgl_appv . " dengan tipe absen " .$tipe_absen->tipe_absen;
                $notifikasi->user_id_penerima    = $user_yang_mengajukan_tidak_masuk->id_user;
                $notifikasi->status              = 0;
                $notifikasi->save();
            }

            alert()->success('Approve Absen Tidak Masuk Berhasil','Terima Kasih');
            return redirect()->back();
        }

        //AVP TAHAP 2
        elseif(auth()->user()->id_level_user == 3){

        AbsensiLog::where('id_absensi',$id)->update([
            'mengetahui' => auth()->user()->nik,
            'terbit' => 1,
        ]);

        if($tipe_absen->tipe_absen == "Cuti"){

            $hasil_pengurangan_cuti = $data_karyawan->sisa_cuti - 1;

            Karyawan::where('nik',$tipe_absen->nik)->update([
                'sisa_cuti' => $hasil_pengurangan_cuti,
            ]);
        }

        $hadir                          = new PresensiLog();
        $hadir->id_absensi              = $data_tidak_masuk->id_absensi;
        $hadir->nik                     = $data_tidak_masuk->nik;
        $hadir->tanggal                 = $fixed_tgl;
        $hadir->jadwal_kerja            = $data_tidak_masuk->tipe_absen;
        $hadir->lat                     = null;
        $hadir->lng                     = null;
        $hadir->id_zona                 = $data_karyawan->id_zona;
        $hadir->id_regu                 = $data_karyawan->id_regu;
        $hadir->id_jabatan              = $data_karyawan->id_jabatan;
        $hadir->check_in                = null;
        $hadir->check_out               = null;
        $hadir->status                  = "off_duty";
        $hadir->detail                  = $data_tidak_masuk->detail;
        $hadir->save();

        $notifikasi                      = new Notifikasi();
        $notifikasi->kategori_notifikasi = "Approve";
        $notifikasi->judul_notifikasi    = "Pengajuan Tidak Masuk Disetujui";
        $notifikasi->isi_notifikasi      = "Pengajuan tidak masuk kerja pada tanggal " .$tgl_appv . " dengan tipe absen " .$tipe_absen->tipe_absen;
        $notifikasi->user_id_penerima    = $user_yang_mengajukan_tidak_masuk->id_user;
        $notifikasi->status              = 0;
        $notifikasi->save();

        alert()->success('Approve Absen Tidak Masuk Berhasil','Terima Kasih');
        return redirect()->back();
        }

        //SUPERVISOR
        elseif(auth()->user()->id_level_user == 4){

            //TAHAP 2
            if(!is_null($cek_data_tahap_1->validasi)){

                AbsensiLog::where('id_absensi',$id)->update([
                    'mengetahui' => auth()->user()->nik,
                    'terbit' => 1,
                ]);

                if($tipe_absen->tipe_absen == "Cuti"){

                    $hasil_pengurangan_cuti = $data_karyawan->sisa_cuti - 1;

                    Karyawan::where('nik',$tipe_absen->nik)->update([
                        'sisa_cuti' => $hasil_pengurangan_cuti,
                    ]);
                }

                $hadir                          = new PresensiLog();
                $hadir->id_absensi              = $data_tidak_masuk->id_absensi;
                $hadir->nik                     = $data_tidak_masuk->nik;
                $hadir->tanggal                 = $fixed_tgl;
                $hadir->jadwal_kerja            = $data_tidak_masuk->tipe_absen;
                $hadir->lat                     = null;
                $hadir->lng                     = null;
                $hadir->id_zona                 = $data_karyawan->id_zona;
                $hadir->id_regu                 = $data_karyawan->id_regu;
                $hadir->id_jabatan              = $data_karyawan->id_jabatan;
                $hadir->check_in                = null;
                $hadir->check_out               = null;
                $hadir->status                  = "off_duty";
                $hadir->detail                  = $data_tidak_masuk->detail;
                $hadir->save();

                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Approve";
                $notifikasi->judul_notifikasi    = "Pengajuan Tidak Masuk Disetujui";
                $notifikasi->isi_notifikasi      = "Pengajuan tidak masuk kerja pada tanggal " .$tgl_appv . " dengan tipe absen " .$tipe_absen->tipe_absen;
                $notifikasi->user_id_penerima    = $user_yang_mengajukan_tidak_masuk->id_user;
                $notifikasi->status              = 0;
                $notifikasi->save();

                alert()->success('Approve Absen Tidak Masuk Berhasil','Terima Kasih');
                return redirect()->back();
            }

            //TAHAP 1
            elseif(is_null($cek_data_tahap_1->validasi)){
                AbsensiLog::where('id_absensi',$id)->update([
                    'validasi' => auth()->user()->nik,
                ]);

                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Pengajuan";
                $notifikasi->judul_notifikasi    = "Pengajuan Tidak Masuk";
                $notifikasi->isi_notifikasi      = $dt_abs->nama_lengkap. " Mengajukan Tidak Masuk Kerja pada tanggal " .$dt_abs->tgl_absen;
                $notifikasi->user_id_penerima    = $dt_user_penerima->id_user;
                $notifikasi->status              = 0;
                $notifikasi->save();

                alert()->success('Approve Absen Tidak Masuk Berhasil','Terima Kasih');
                return redirect()->back();
            }
        }


        //STAFFPG TAHAP 1
        elseif(auth()->user()->id_level_user == 5){

        AbsensiLog::where('id_absensi',$id)->update([
            'validasi' => auth()->user()->nik,
        ]);

        $notifikasi                      = new Notifikasi();
        $notifikasi->kategori_notifikasi = "Pengajuan";
        $notifikasi->judul_notifikasi    = "Pengajuan Tidak Masuk";
        $notifikasi->isi_notifikasi      = $dt_abs->nama_lengkap. " Mengajukan Tidak Masuk Kerja pada tanggal " .$dt_abs->tgl_absen;
        $notifikasi->user_id_penerima    = $dt_user_penerima->id_user;
        $notifikasi->status              = 0;
        $notifikasi->save();

        alert()->success('Approve Absen Tidak Masuk Berhasil','Terima Kasih');
        return redirect()->back();
        }

        //FOREMAN TAHAP 1
        elseif(auth()->user()->id_level_user == 6){

        $notifikasi                      = new Notifikasi();
        $notifikasi->kategori_notifikasi = "Pengajuan";
        $notifikasi->judul_notifikasi    = "Pengajuan Tidak Masuk";
        $notifikasi->isi_notifikasi      = $dt_abs->nama_lengkap. " Mengajukan Tidak Masuk Kerja pada tanggal " .$dt_abs->tgl_absen;
        $notifikasi->user_id_penerima    = $dt_user_penerima->id_user;
        $notifikasi->status              = 0;
        $notifikasi->save();

        AbsensiLog::where('id_absensi',$id)->update([
            'validasi' => auth()->user()->nik,
        ]);

        alert()->success('Approve Absen Tidak Masuk Berhasil','Terima Kasih');
        return redirect()->back();
        }

        //KAJAGA TAHAP 1
        elseif(auth()->user()->id_level_user == 7){

        AbsensiLog::where('id_absensi',$id)->update([
            'validasi' => auth()->user()->nik,
        ]);

            $notifikasi                      = new Notifikasi();
            $notifikasi->kategori_notifikasi = "Pengajuan";
            $notifikasi->judul_notifikasi    = "Pengajuan Tidak Masuk";
            $notifikasi->isi_notifikasi      = $dt_abs->nama_lengkap. " Mengajukan Tidak Masuk Kerja pada tanggal " .$dt_abs->tgl_absen;
            $notifikasi->user_id_penerima    = $dt_user_penerima->id_user;
            $notifikasi->status              = 0;
            $notifikasi->save();

        alert()->success('Approve Absen Tidak Masuk Berhasil','Terima Kasih');
        return redirect()->back();
        }


        // else{
        //     AbsensiLog::where('id_absensi',$id)->update([
        //         'mengetahui' => auth()->user()->nik,
        //         'terbit' => 1,
        //     ]);

        //     $tipe_absen = DB::table('absensi_logs')->where('id_absensi',$id)->first();

        //     $data_karyawan = DB::table('karyawans')->where('nik',$tipe_absen->nik)->first();

        //     $dt_user_penerima = DB::table('users')->where('nik', $tipe_absen->nik)->first();

        //     if($tipe_absen->tipe_absen == "Cuti"){

        //         $hasil_pengurangan_cuti = $data_karyawan->sisa_cuti - 1;

        //         Karyawan::where('nik',$tipe_absen->nik)->update([
        //             'sisa_cuti' => $hasil_pengurangan_cuti,
        //         ]);
        //     }

        //     $data_tidak_masuk = AbsensiLog::where('id_absensi',$id)->first();

        //     $bulan = ["", "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        //     $tgl = $data_tidak_masuk->tgl_absen;
        //     $exp = explode(" ", $tgl);
        //     $bln_int = array_search($exp[1], $bulan);
        //     $bln_int = str_pad($bln_int, 2, '0', STR_PAD_LEFT);
        //     $tgl_int = str_pad($exp[0], 2, '0', STR_PAD_LEFT);
        //     $fixed_tgl = $exp[2]."-".$bln_int."-".$tgl_int;

        //     $tgl_appv = $tgl_int."-".$bln_int."-".$exp[2];

        //     $hadir                          = new PresensiLog();
        //     $hadir->id_absensi              = $data_tidak_masuk->id_absensi;
        //     $hadir->nik                     = $data_tidak_masuk->nik;
        //     $hadir->tanggal                 = $fixed_tgl;
        //     $hadir->jadwal_kerja            = $data_tidak_masuk->tipe_absen;
        //     $hadir->lat                     = null;
        //     $hadir->lng                     = null;
        //     $hadir->id_zona                 = $data_karyawan->id_zona;
        //     $hadir->id_regu                 = $data_karyawan->id_regu;
        //     $hadir->id_jabatan              = $data_karyawan->id_jabatan;
        //     $hadir->check_in                = null;
        //     $hadir->check_out               = null;
        //     $hadir->status                  = "off_duty";
        //     $hadir->detail                  = $data_tidak_masuk->detail;
        //     $hadir->save();

        //     $notifikasi                      = new Notifikasi();
        //     $notifikasi->kategori_notifikasi = "Approve";
        //     $notifikasi->judul_notifikasi    = "Pengajuan Tidak Masuk Disetujui";
        //     $notifikasi->isi_notifikasi      = "Pengajuan tidak masuk kerja pada tanggal " .$tgl_appv . " dengan tipe absen " .$tipe_absen->tipe_absen;
        //     $notifikasi->user_id_penerima    = $dt_user_penerima->id_user;
        //     $notifikasi->status              = 0;
        //     $notifikasi->save();

                // alert()->success('Approve Absen Tidak Masuk Berhasil','Terima Kasih');
                // return redirect()->back();
        // }



    }

    public function reject_tidak_masuk($id)
    {

        AbsensiLog::where('id_absensi',$id)->update([
            'reject' => 1,
            'reject_by' => auth()->user()->nik
        ]);

        $data_tm = DB::table('absensi_logs')->where('id_absensi',$id)->first();

        $tgl_appv = date("d-m-Y", strtotime($data_tm->tgl_absen));

        $dt_nama_reject = DB::table('karyawans')->where('nik',auth()->user()->nik)->first();

        $dt_user_penerima = DB::table('users')->where('nik', $data_tm->nik)->first();

        $notifikasi                      = new Notifikasi();
        $notifikasi->kategori_notifikasi = "Reject";
        $notifikasi->judul_notifikasi    = "Pengajuan Tidak Masuk Ditolak oleh ".$dt_nama_reject->nama_lengkap;
        $notifikasi->isi_notifikasi      = "Pengajuan tidak masuk kerja pada tanggal " .$tgl_appv . " dengan tipe absen " .$data_tm->tipe_absen;
        $notifikasi->user_id_penerima    = $dt_user_penerima->id_user;
        $notifikasi->status              = 0;
        $notifikasi->save();

        alert()->success('Reject Absen Tidak Masuk Berhasil','Terima Kasih');
        return redirect()->back();

    }

    public function approve_lembur($id)
    {

        $cek_data_tahap_1 = DB::table('lemburs')->where('id_lembur',$id)->first();

        $dt_lembur = DB::table('lemburs')
                    ->join('karyawans','karyawans.nik','=','lemburs.nik')
                    ->where('lemburs.id_lembur',$id)->first();

        $jabatan = DB::table('karyawans')
                    ->join('jabatans','jabatans.id_jabatan' , '=' , 'karyawans.id_jabatan')
                    ->where('karyawans.nik',$dt_lembur->nik)
                    ->first();

        //NOTIF KE TAHAP 2
        $dt_kar_penerima = DB::table('karyawans')
                    ->where('id_jabatan', $jabatan->direct_jab_atasan_2)
                    ->first();

        $dt_user_penerima = DB::table('users')
                    ->where('nik', $dt_kar_penerima->nik)
                    ->first();

        //NOTIF KE YANG MENGAJUKAN
        $lembur = DB::table('lemburs')->where('id_lembur',$id)->first();

        $data_karyawan = DB::table('karyawans')->where('nik',$lembur->nik)->first();

        $user_yang_mengajukan_spl = DB::table('users')->where('nik', $lembur->nik)->first();


        $data_lembur = Lembur::where('id_lembur',$id)->first();

        $bulan = ["", "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        $tgl = $data_lembur->tgl_lembur;
        $exp = explode(" ", $tgl);
        $bln_int = array_search($exp[1], $bulan);
        $bln_int = str_pad($bln_int, 2, '0', STR_PAD_LEFT);
        $tgl_int = str_pad($exp[0], 2, '0', STR_PAD_LEFT);

        $tgl_appv_lembur = $tgl_int."-".$bln_int."-".$exp[2];

        //SUPER ADMIN
        if(auth()->user()->id_level_user == 1){
            $cek_data = Lembur::where('id_lembur',$id)->select('validasi')->first();

            //SUPER ADMIN TAHAP 1
            if($cek_data->validasi === null)
            {
                Lembur::where('id_lembur',$id)->update([
                    'validasi' => auth()->user()->nik,
                ]);

                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Pengajuan";
                $notifikasi->judul_notifikasi    = "Pengajuan Lembur SPL";
                $notifikasi->isi_notifikasi      = "Pengajuan Lembur SPL pada tanggal " .$tgl_appv_lembur . " dengan total jam lembur = " .$data_lembur->total_jam_lembur;
                $notifikasi->user_id_penerima    = $dt_user_penerima->id_user;
                $notifikasi->status              = 0;
                $notifikasi->save();
            }
            //SUPER ADMIN TAHAP 2
            else
            {
                Lembur::where('id_lembur',$id)->update([
                    'mengetahui' => auth()->user()->nik,
                    'terbit' => 1,
                ]);

                $data_lembur = Lembur::where('id_lembur',$id)->first();
                $tgl = date("Y-m-d", strtotime($data_lembur->tgl_lembur));

                PresensiLog::whereDate('tanggal',$tgl)->where('nik', $data_lembur->nik)
                ->update(['id_lembur' => $data_lembur->id_lembur]);


                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Approve";
                $notifikasi->judul_notifikasi    = "Pengajuan Lembur SPL Disetujui";
                $notifikasi->isi_notifikasi      = "Pengajuan Lembur SPL pada tanggal " .$tgl_appv_lembur . " dengan total jam lembur = " .$data_lembur->total_jam_lembur;
                $notifikasi->user_id_penerima    = $user_yang_mengajukan_spl->id_user;
                $notifikasi->status              = 0;
                $notifikasi->save();
            }
            alert()->success('Approve Surat Perintah Lembur (SPL) Berhasil','Terima Kasih');
            return redirect()->back();

        }

        //AVP TAHAP 2
        elseif(auth()->user()->id_level_user == 3){

        Lembur::where('id_lembur',$id)->update([
                    'mengetahui' => auth()->user()->nik,
                    'terbit' => 1,
        ]);

        $data_lembur = Lembur::where('id_lembur',$id)->first();
        $tgl = date("Y-m-d", strtotime($data_lembur->tgl_lembur));

        PresensiLog::whereDate('tanggal',$tgl)->where('nik', $data_lembur->nik)
        ->update(['id_lembur' => $data_lembur->id_lembur]);

        $notifikasi                      = new Notifikasi();
        $notifikasi->kategori_notifikasi = "Approve";
        $notifikasi->judul_notifikasi    = "Pengajuan Lembur SPL Disetujui";
        $notifikasi->isi_notifikasi      = "Pengajuan Lembur SPL pada tanggal " .$tgl_appv_lembur . " dengan total jam lembur = " .$data_lembur->total_jam_lembur;
        $notifikasi->user_id_penerima    = $user_yang_mengajukan_spl->id_user;
        $notifikasi->status              = 0;
        $notifikasi->save();

        alert()->success('Approve Surat Perintah Lembur (SPL) Berhasil','Terima Kasih');
        return redirect()->back();

        }

        //SUPERVISOR TAHAP 2
        elseif(auth()->user()->id_level_user == 4 ){

            if(!is_null($cek_data_tahap_1->validasi)){
                Lembur::where('id_lembur',$id)->update([
                            'mengetahui' => auth()->user()->nik,
                            'terbit' => 1,
                ]);

                $data_lembur = Lembur::where('id_lembur',$id)->first();
                $tgl = date("Y-m-d", strtotime($data_lembur->tgl_lembur));

                PresensiLog::whereDate('tanggal',$tgl)->where('nik', $data_lembur->nik)
                ->update(['id_lembur' => $data_lembur->id_lembur]);

                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Approve";
                $notifikasi->judul_notifikasi    = "Pengajuan Lembur SPL Disetujui";
                $notifikasi->isi_notifikasi      = "Pengajuan Lembur SPL pada tanggal " .$tgl_appv_lembur . " dengan total jam lembur = " .$data_lembur->total_jam_lembur;
                $notifikasi->user_id_penerima    = $user_yang_mengajukan_spl->id_user;
                $notifikasi->status              = 0;
                $notifikasi->save();

                alert()->success('Approve Surat Perintah Lembur (SPL) Berhasil','Terima Kasih');
                return redirect()->back();
            }

            elseif(is_null($cek_data_tahap_1->validasi)){
                Lembur::where('id_lembur',$id)->update([
                    'validasi' => auth()->user()->nik,
                ]);

                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Pengajuan";
                $notifikasi->judul_notifikasi    = "Pengajuan Lembur SPL";
                $notifikasi->isi_notifikasi      = "Pengajuan Lembur SPL pada tanggal " .$tgl_appv_lembur . " dengan total jam lembur = " .$data_lembur->total_jam_lembur;
                $notifikasi->user_id_penerima    = $dt_user_penerima->id_user;
                $notifikasi->status              = 0;
                $notifikasi->save();

                alert()->success('Approve Surat Perintah Lembur (SPL) Berhasil','Terima Kasih');
                return redirect()->back();
            }

        }
        //STAFF TAHAP 1
        elseif(auth()->user()->id_level_user == 5){
            Lembur::where('id_lembur',$id)->update([
                'validasi' => auth()->user()->nik,
            ]);

            $notifikasi                      = new Notifikasi();
            $notifikasi->kategori_notifikasi = "Pengajuan";
            $notifikasi->judul_notifikasi    = "Pengajuan Lembur SPL";
            $notifikasi->isi_notifikasi      = "Pengajuan Lembur SPL pada tanggal " .$tgl_appv_lembur . " dengan total jam lembur = " .$data_lembur->total_jam_lembur;
            $notifikasi->user_id_penerima    = $dt_user_penerima->id_user;
            $notifikasi->status              = 0;
            $notifikasi->save();

            alert()->success('Approve Surat Perintah Lembur (SPL) Berhasil','Terima Kasih');
            return redirect()->back();
        }

        //FOREMAN TAHAP 1
        elseif(auth()->user()->id_level_user == 6){
            Lembur::where('id_lembur',$id)->update([
                'validasi' => auth()->user()->nik,
            ]);

            $notifikasi                      = new Notifikasi();
            $notifikasi->kategori_notifikasi = "Pengajuan";
            $notifikasi->judul_notifikasi    = "Pengajuan Lembur SPL";
            $notifikasi->isi_notifikasi      = "Pengajuan Lembur SPL pada tanggal " .$tgl_appv_lembur . " dengan total jam lembur = " .$data_lembur->total_jam_lembur;
            $notifikasi->user_id_penerima    = $dt_user_penerima->id_user;
            $notifikasi->status              = 0;
            $notifikasi->save();

            alert()->success('Approve Surat Perintah Lembur (SPL) Berhasil','Terima Kasih');
            return redirect()->back();
        }

        //KAJAGA TAHAP 1
        elseif(auth()->user()->id_level_user == 7){
            Lembur::where('id_lembur',$id)->update([
                'validasi' => auth()->user()->nik,
            ]);

            $notifikasi                      = new Notifikasi();
            $notifikasi->kategori_notifikasi = "Pengajuan";
            $notifikasi->judul_notifikasi    = "Pengajuan Lembur SPL";
            $notifikasi->isi_notifikasi      = "Pengajuan Lembur SPL pada tanggal " .$tgl_appv_lembur . " dengan total jam lembur = " .$data_lembur->total_jam_lembur;
            $notifikasi->user_id_penerima    = $dt_user_penerima->id_user;
            $notifikasi->status              = 0;
            $notifikasi->save();

            alert()->success('Approve Surat Perintah Lembur (SPL) Berhasil','Terima Kasih');
            return redirect()->back();
        }

        // else{
        // Lembur::where('id_lembur',$id)->update([
        //     'mengetahui' => auth()->user()->nik,
        //     'terbit' => 1,
        // ]);

        // $data_lembur = Lembur::where('id_lembur',$id)->first();

        // $tgl = date("Y-m-d", strtotime($data_lembur->tgl_lembur));

        // PresensiLog::whereDate('tanggal',$tgl)->where('nik', $data_lembur->nik)
        // ->update(['id_lembur' => $data_lembur->id_lembur]);

        // $notifikasi                      = new Notifikasi();
        // $notifikasi->kategori_notifikasi = "Pengajuan";
        // $notifikasi->judul_notifikasi    = "Pengajuan Lembur";
        // $notifikasi->isi_notifikasi      = $dt_lembur->nama_lengkap. " Mengajukan Tidak Masuk Kerja pada tanggal " .$dt_lembur->tgl_lembur;
        // $notifikasi->user_id_penerima    = $dt_user_penerima->id_user;
        // $notifikasi->status              = 0;
        // $notifikasi->save();

        // alert()->success('Approve Surat Perintah Lembur (SPL) Berhasil','Terima Kasih');
        // return redirect()->back();
        // }

    }

    public function reject_lembur($id)
    {
        Lembur::where('id_lembur',$id)->update([
            'reject' => 1,
            'reject_by' => auth()->user()->nik
        ]);

        $data_lembur = DB::table('lemburs')->where('id_lembur',$id)->first();

        $tgl_spl = date("d-m-Y", strtotime($data_lembur->tgl_lembur));

        $dt_nama_reject = DB::table('karyawans')->where('nik',auth()->user()->nik)->first();

        $dt_user_penerima = DB::table('users')->where('nik', $data_lembur->nik)->first();

        $notifikasi                      = new Notifikasi();
        $notifikasi->kategori_notifikasi = "Reject";
        $notifikasi->judul_notifikasi    = "Pengajuan Lembur SPL Ditolak";
        $notifikasi->isi_notifikasi      = "Pengajuan Lembur SPL pada tanggal " .$tgl_spl. " di Tolak oleh " .$dt_nama_reject->nama_lengkap;
        $notifikasi->user_id_penerima    = $dt_user_penerima->id_user;
        $notifikasi->status              = 0;
        $notifikasi->save();

        alert()->success('Reject Surat Perintah Lembur (SPL) Berhasil','Terima Kasih');
        return redirect()->back();

    }

    public function approve_lembur_khusus($id)
    {

        $cek_data = LemburKhusus::where('id_lembur_khusus',$id)->select('validasi','mengetahui','approve')->first();

        $dt_lembur_khusus = DB::table('lembur_khususes')
                    ->join('karyawans','karyawans.nik','=','lembur_khususes.nik')
                    ->where('lembur_khususes.id_lembur_khusus',$id)->first();

        $jabatan = DB::table('karyawans')
                    ->join('jabatans','jabatans.id_jabatan' , '=' , 'karyawans.id_jabatan')
                    ->where('karyawans.nik',$dt_lembur_khusus->nik)
                    ->first();

        //NOTIF KE TAHAP 2
        $dt_kar_penerima = DB::table('karyawans')
                    ->where('id_jabatan', $jabatan->direct_jab_atasan_2)
                    ->first();

        $dt_user_penerima_tahap_2 = DB::table('users')
                    ->where('nik', $dt_kar_penerima->nik)
                    ->first();

        //NOTIF KE TAHAP 3
        $cek_klasifikasi = LemburKhusus::where('id_lembur_khusus',$id)->first();

        if($cek_klasifikasi->klasifikasi_zona == "OPS&MIN"){
            $dt_avp_penerima = Karyawan::where('id_jabatan', 2)
                        ->first();

            $dt_user_penerima_tahap_3 = DB::table('users')
                        ->where('nik', $dt_avp_penerima->nik)
                        ->first();
        }
        elseif($cek_klasifikasi->klasifikasi_zona == "KAWASAN"){
            $dt_avp_penerima = DB::table('karyawans')
                        ->where('id_jabatan', 3)
                        ->first();

            $dt_user_penerima_tahap_3 = DB::table('users')
                        ->where('nik', $dt_avp_penerima->nik)
                        ->first();
        }

        elseif($cek_klasifikasi->klasifikasi_zona == "PABRIK"){
            $dt_avp_penerima = Karyawan::where('id_jabatan', 4)
                        ->first();

            $dt_user_penerima_tahap_3 = DB::table('users')
                        ->where('nik', $dt_avp_penerima->nik)
                        ->first();
        }

        //NOTIF KE YANG MENGAJUKAN
        $lembur_khusus = DB::table('lembur_khususes')->where('id_lembur_khusus',$id)->first();

        $data_karyawan = DB::table('karyawans')->where('nik',$lembur_khusus->nik)->first();

        $user_yang_mengajukan_lk = DB::table('users')->where('nik', $lembur_khusus->nik)->first();


        $data_lembur_khusus = LemburKhusus::where('id_lembur_khusus',$id)->first();

        $bulan = ["", "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        $tgl = $data_lembur_khusus->tgl_lembur_khusus;
        $exp = explode(" ", $tgl);
        $bln_int = array_search($exp[1], $bulan);
        $bln_int = str_pad($bln_int, 2, '0', STR_PAD_LEFT);
        $tgl_int = str_pad($exp[0], 2, '0', STR_PAD_LEFT);

        $tgl_appv_lembur_khusus = $tgl_int."-".$bln_int."-".$exp[2];

        //SUPER ADMIN
        if(auth()->user()->id_level_user == 1){

            //TAHAP 1
            if($cek_data->validasi === null)
            {
                LemburKhusus::where('id_lembur_khusus',$id)->update([
                    'validasi' => auth()->user()->nik,
                ]);

                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Pengajuan";
                $notifikasi->judul_notifikasi    = "Pengajuan Lembur Khusus";
                $notifikasi->isi_notifikasi      = "Pengajuan Lembur Khusus pada tanggal " .$tgl_appv_lembur_khusus . " dengan total jam lembur = " .$data_lembur_khusus->total_jam_lembur_khusus;
                $notifikasi->user_id_penerima    = $dt_user_penerima_tahap_2->id_user;
                $notifikasi->status              = 0;
                $notifikasi->save();
            }
            //TAHAP 2
            elseif($cek_data->mengetahui === null)
            {
                LemburKhusus::where('id_lembur_khusus',$id)->update([
                    'mengetahui' => auth()->user()->nik,
                ]);

                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Pengajuan";
                $notifikasi->judul_notifikasi    = "Pengajuan Lembur Khusus";
                $notifikasi->isi_notifikasi      = "Pengajuan Lembur Khusus pada tanggal " .$tgl_appv_lembur_khusus . " dengan total jam lembur = " .$data_lembur_khusus->total_jam_lembur_khusus;
                $notifikasi->user_id_penerima    = $dt_user_penerima_tahap_3->id_user;
                $notifikasi->status              = 0;
                $notifikasi->save();
            }
            //TAHAP 3
            elseif($cek_data->approve === null)
            {
                LemburKhusus::where('id_lembur_khusus',$id)->update([
                    'approve' => auth()->user()->nik,
                    'terbit' => 1,
                ]);

                $data_lembur_khusus = LemburKhusus::where('id_lembur_khusus',$id)->first();

                $tgl = date("Y-m-d", strtotime($data_lembur_khusus->tgl_lembur_khusus));

                PresensiLog::whereDate('tanggal',$tgl)->Where('nik', $data_lembur_khusus->nik)
                ->update(['id_lembur_khusus' => $data_lembur_khusus->id_lembur_khusus]);

                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Approve";
                $notifikasi->judul_notifikasi    = "Pengajuan Lembur Khusus Disetujui";
                $notifikasi->isi_notifikasi      = "Pengajuan Lembur Khusus pada tanggal " .$tgl_appv_lembur_khusus . " dengan total jam lembur = " .$data_lembur_khusus->total_jam_lembur_khusus ." Disetujui";
                $notifikasi->user_id_penerima    = $user_yang_mengajukan_lk->id_user;
                $notifikasi->status              = 0;
                $notifikasi->save();

            }

            alert()->success('Approve Lembur Khusus Berhasil','Terima Kasih');
            return redirect()->back();
        }

        //AVP TAHAP 3
        elseif(auth()->user()->id_level_user == 3){
            LemburKhusus::where('id_lembur_khusus',$id)->update([
                'approve' => auth()->user()->nik,
                'terbit' => 1,
            ]);

            $data_lembur_khusus = LemburKhusus::where('id_lembur_khusus',$id)->first();

            $tgl = date("Y-m-d", strtotime($data_lembur_khusus->tgl_lembur_khusus));

            PresensiLog::whereDate('tanggal',$tgl)->Where('nik', $data_lembur_khusus->nik)
            ->update(['id_lembur_khusus' => $data_lembur_khusus->id_lembur_khusus]);

            $notifikasi                      = new Notifikasi();
            $notifikasi->kategori_notifikasi = "Approve";
            $notifikasi->judul_notifikasi    = "Pengajuan Lembur Khusus Disetujui";
            $notifikasi->isi_notifikasi      = "Pengajuan Lembur Khusus pada tanggal " .$tgl_appv_lembur_khusus . " dengan total jam lembur = " .$data_lembur_khusus->total_jam_lembur_khusus ." Disetujui";
            $notifikasi->user_id_penerima    = $user_yang_mengajukan_lk->id_user;
            $notifikasi->status              = 0;
            $notifikasi->save();

            alert()->success('Approve Lembur Khusus Berhasil','Terima Kasih');
            return redirect()->back();
        }

        //SVP TAHAP 2
        elseif(auth()->user()->id_level_user == 4 && $cek_data->mengetahui === null){
            LemburKhusus::where('id_lembur_khusus',$id)->update([
                'mengetahui' => auth()->user()->nik,
            ]);

            $notifikasi                      = new Notifikasi();
            $notifikasi->kategori_notifikasi = "Pengajuan";
            $notifikasi->judul_notifikasi    = "Pengajuan Lembur Khusus";
            $notifikasi->isi_notifikasi      = "Pengajuan Lembur Khusus pada tanggal " .$tgl_appv_lembur_khusus . " dengan total jam lembur = " .$data_lembur_khusus->total_jam_lembur_khusus;
            $notifikasi->user_id_penerima    = $dt_user_penerima_tahap_3->id_user;
            $notifikasi->status              = 0;
            $notifikasi->save();

            alert()->success('Approve Lembur Khusus Berhasil','Terima Kasih');
            return redirect()->back();
        }

        //STAFF TAHAP 1
        elseif(auth()->user()->id_level_user == 5 && $cek_data->validasi === null){
            LemburKhusus::where('id_lembur_khusus',$id)->update([
                'validasi' => auth()->user()->nik,
            ]);

            $notifikasi                      = new Notifikasi();
            $notifikasi->kategori_notifikasi = "Pengajuan";
            $notifikasi->judul_notifikasi    = "Pengajuan Lembur Khusus";
            $notifikasi->isi_notifikasi      = "Pengajuan Lembur Khusus pada tanggal " .$tgl_appv_lembur_khusus . " dengan total jam lembur = " .$data_lembur_khusus->total_jam_lembur_khusus;
            $notifikasi->user_id_penerima    = $dt_user_penerima_tahap_2->id_user;
            $notifikasi->status              = 0;
            $notifikasi->save();

            alert()->success('Approve Lembur Khusus Berhasil','Terima Kasih');
            return redirect()->back();
        }

        //FOREMAN TAHAP 1
        elseif(auth()->user()->id_level_user == 6 && $cek_data->validasi === null){
            LemburKhusus::where('id_lembur_khusus',$id)->update([
                'validasi' => auth()->user()->nik,
            ]);

            $notifikasi                      = new Notifikasi();
            $notifikasi->kategori_notifikasi = "Pengajuan";
            $notifikasi->judul_notifikasi    = "Pengajuan Lembur Khusus";
            $notifikasi->isi_notifikasi      = "Pengajuan Lembur Khusus pada tanggal " .$tgl_appv_lembur_khusus . " dengan total jam lembur = " .$data_lembur_khusus->total_jam_lembur_khusus;
            $notifikasi->user_id_penerima    = $dt_user_penerima_tahap_2->id_user;
            $notifikasi->status              = 0;
            $notifikasi->save();

            alert()->success('Approve Lembur Khusus Berhasil','Terima Kasih');
            return redirect()->back();
        }

        //KAJAGA TAHAP 1
        elseif(auth()->user()->id_level_user == 7 && $cek_data->validasi === null){
            LemburKhusus::where('id_lembur_khusus',$id)->update([
                'validasi' => auth()->user()->nik,
            ]);

            $notifikasi                      = new Notifikasi();
            $notifikasi->kategori_notifikasi = "Pengajuan";
            $notifikasi->judul_notifikasi    = "Pengajuan Lembur Khusus";
            $notifikasi->isi_notifikasi      = "Pengajuan Lembur Khusus pada tanggal " .$tgl_appv_lembur_khusus . " dengan total jam lembur = " .$data_lembur_khusus->total_jam_lembur_khusus;
            $notifikasi->user_id_penerima    = $dt_user_penerima_tahap_2->id_user;
            $notifikasi->status              = 0;
            $notifikasi->save();

            alert()->success('Approve Lembur Khusus Berhasil','Terima Kasih');
            return redirect()->back();
        }

        // else{
        // LemburKhusus::where('id_lembur_khusus',$id)->update([
        //     'approve' => auth()->user()->nik,
        //     'terbit' => "1"
        // ]);

        // $data_lembur_khusus = LemburKhusus::where('id_lembur_khusus',$id)->first();

        // $tgl = date("Y-m-d", strtotime($data_lembur_khusus->tgl_lembur_khusus));

        // PresensiLog::whereDate('tanggal',$tgl)->Where('nik', $data_lembur_khusus->nik)
        // ->update(['id_lembur_khusus' => $data_lembur_khusus->id_lembur_khusus]);

        // alert()->success('Approve Lembur Khusus Berhasil','Terima Kasih');
        // return redirect()->back();
        // }

    }

    public function reject_lembur_khusus($id)
    {

        LemburKhusus::where('id_lembur_khusus',$id)->update([
            'reject' => 1,
            'reject_by' => auth()->user()->nik
        ]);

        $data_lembur_khusus = DB::table('lembur_khususes')->where('id_lembur_khusus',$id)->first();

        $tgl_lk = date("d-m-Y", strtotime($data_lembur_khusus->tgl_lembur_khusus));

        $dt_nama_reject = DB::table('karyawans')->where('nik',auth()->user()->nik)->first();

        $dt_user_penerima = DB::table('users')->where('nik', $data_lembur_khusus->nik)->first();

        $notifikasi                      = new Notifikasi();
        $notifikasi->kategori_notifikasi = "Reject";
        $notifikasi->judul_notifikasi    = "Pengajuan Lembur Khusus Ditolak";
        $notifikasi->isi_notifikasi      = "Pengajuan Lembur Khusus pada tanggal " .$tgl_lk. " di Tolak oleh ".$dt_nama_reject->nama_lengkap;
        $notifikasi->user_id_penerima    = $dt_user_penerima->id_user;
        $notifikasi->status              = 0;
        $notifikasi->save();

        alert()->success('Reject Lembur Khusus Berhasil','Terima Kasih');
        return redirect()->back();

    }

    public function approve_tukar_shift($id)
    {

        $cek_data = TukarShift::where('id_tukar_shift',$id)->select('apv_pihak2','apv_kajaga_p1','apv_kajaga_p2')->first();

        $dt_tukar_shift = DB::table('tukar_shifts')
                    ->join('karyawans','karyawans.nik','=','tukar_shifts.nik_pihak1')
                    ->where('tukar_shifts.id_tukar_shift',$id)->first();

        //NOTIF KE TAHAP 1
        $dt_user_penerima_tahap_1 = DB::table('users')
                    ->where('nik', $dt_tukar_shift->nik_pihak2)
                    ->first();

        $pihak_2 = DB::table('karyawans')
                    ->where('nik', $dt_tukar_shift->nik_pihak2)
                    ->first();

        //NOTIF KE TAHAP 2
        $dt_user_penerima_tahap_2 = DB::table('users')
                    ->where('nik', $dt_tukar_shift->nik_kajaga_pihak1)
                    ->first();
        $kajaga_pihak_1 = DB::table('karyawans')
                    ->where('nik', $dt_tukar_shift->nik_kajaga_pihak1)
                    ->first();

        //NOTIF KE TAHAP 3
        $dt_user_penerima_tahap_3 = DB::table('users')
                    ->where('nik', $dt_tukar_shift->nik_kajaga_pihak2)
                    ->first();
        $kajaga_pihak_2 = DB::table('karyawans')
                    ->where('nik', $dt_tukar_shift->nik_kajaga_pihak2)
                    ->first();

        //NOTIF KE YANG MENGAJUKAN
        $dt_user_yang_mengajukan = DB::table('users')
                    ->where('nik', $dt_tukar_shift->nik_pihak1)
                    ->first();
        $pihak_1 = DB::table('karyawans')
                    ->where('nik', $dt_tukar_shift->nik_pihak1)
                    ->first();


        $data_tukar_shift = TukarShift::where('id_tukar_shift',$id)->first();

        // $bulan = ["", "Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        // $tgl = $data_tukar_shift->tgl_tukar;
        // $exp = explode(" ", $tgl);
        // $bln_int = array_search($exp[1], $bulan);
        // $bln_int = str_pad($bln_int, 2, '0', STR_PAD_LEFT);
        // $tgl_int = str_pad($exp[0], 2, '0', STR_PAD_LEFT);
        // $fixed_tgl = $exp[2]."-".$bln_int."-".$tgl_int;
        // $tgl_appv_tukar_shift = date("d-m-Y", strtotime($tgl));

        $tgl_appv_tukar_shift = $data_tukar_shift->tgl_tukar;

        //SUPER ADMIN
        if(auth()->user()->id_level_user == 1){

            //TAHAP 1
            if($cek_data->apv_pihak2 === null)
            {
                TukarShift::where('id_tukar_shift',$id)->update([
                    'apv_pihak2' => auth()->user()->nik,
                ]);

                $notifikasi                         = new Notifikasi();
                $notifikasi->kategori_notifikasi    = "Pengajuan";
                $notifikasi->judul_notifikasi       = "Pengajuan Tukar Shift";
                $notifikasi->isi_notifikasi         = $pihak_1->nama_lengkap." mengajukan Tukar Shift kepada " .$pihak_2->nama_lengkap. " pada tanggal ". $tgl_appv_tukar_shift . " dengan rincian jadwal ".$pihak_1->nama_lengkap. " seharusnya | ". $dt_tukar_shift->awal_jam_kerja . " menjadi " . $dt_tukar_shift->ubah_jam_kerja ." perlu persetujuan dari ".$kajaga_pihak_1->nama_lengkap;
                $notifikasi->user_id_penerima       = $dt_user_penerima_tahap_2->id_user;
                $notifikasi->status                 = 0;
                $notifikasi->save();

            }
            //TAHAP 2
            elseif($cek_data->apv_kajaga_p1 === null)
            {
                TukarShift::where('id_tukar_shift',$id)->update([
                    'apv_kajaga_p1' => auth()->user()->nik,
                ]);

                $notifikasi                         = new Notifikasi();
                $notifikasi->kategori_notifikasi    = "Pengajuan";
                $notifikasi->judul_notifikasi       = "Pengajuan Tukar Shift";
                $notifikasi->isi_notifikasi         = $pihak_1->nama_lengkap." mengajukan Tukar Shift kepada " .$pihak_2->nama_lengkap. " pada tanggal ". $tgl_appv_tukar_shift . " dengan rincian jadwal ".$pihak_1->nama_lengkap. " seharusnya | ". $dt_tukar_shift->awal_jam_kerja . " menjadi " . $dt_tukar_shift->ubah_jam_kerja ." perlu persetujuan dari ".$kajaga_pihak_2->nama_lengkap;
                $notifikasi->user_id_penerima       = $dt_user_penerima_tahap_3->id_user;
                $notifikasi->status                 = 0;
                $notifikasi->save();
            }
            //TAHAP 3
            elseif($cek_data->apv_kajaga_p2 === null)
            {
                TukarShift::where('id_tukar_shift',$id)->update([
                    'apv_kajaga_p2' => auth()->user()->nik,
                    'terbit' => 1,
                ]);

                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Approve";
                $notifikasi->judul_notifikasi    = "Approve Tukar Shift";
                $notifikasi->isi_notifikasi      = "Pengajuan Tukar Shift ".$pihak_1->nama_lengkap." kepada " .$pihak_2->nama_lengkap. " pada tanggal ". $tgl_appv_tukar_shift . " dengan rincian jadwal ".$pihak_1->nama_lengkap. " seharusnya | ". $dt_tukar_shift->awal_jam_kerja . " menjadi " . $dt_tukar_shift->ubah_jam_kerja ." di setujui ";
                $notifikasi->user_id_penerima    = $dt_user_yang_mengajukan->id_user;
                $notifikasi->status              = 0;
                $notifikasi->save();

            }
            alert()->success('Approve Lembur Khusus Berhasil','Terima Kasih');
            return redirect()->back();
        }

        //FOREMAN
        elseif(auth()->user()->id_level_user == 6){

            //TAHAP 2
            if($cek_data->apv_kajaga_p1 === null)
            {
                TukarShift::where('id_tukar_shift',$id)->update([
                    'apv_kajaga_p1' => auth()->user()->nik,
                ]);

                $notifikasi                         = new Notifikasi();
                $notifikasi->kategori_notifikasi    = "Pengajuan";
                $notifikasi->judul_notifikasi       = "Pengajuan Tukar Shift";
                $notifikasi->isi_notifikasi         = $pihak_1->nama_lengkap." mengajukan Tukar Shift kepada " .$pihak_2->nama_lengkap. " pada tanggal ". $tgl_appv_tukar_shift . " dengan rincian jadwal ".$pihak_1->nama_lengkap. " seharusnya | ". $dt_tukar_shift->awal_jam_kerja . " menjadi " . $dt_tukar_shift->ubah_jam_kerja ." perlu persetujuan dari ".$kajaga_pihak_2->nama_lengkap;
                $notifikasi->user_id_penerima       = $dt_user_penerima_tahap_3->id_user;
                $notifikasi->status                 = 0;
                $notifikasi->save();
            }
            //TAHAP 3
            elseif($cek_data->apv_kajaga_p2 === null)
            {
                TukarShift::where('id_tukar_shift',$id)->update([
                    'apv_kajaga_p2' => auth()->user()->nik,
                    'terbit' => 1,
                ]);

                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Approve";
                $notifikasi->judul_notifikasi    = "Approve Tukar Shift";
                $notifikasi->isi_notifikasi      = "Pengajuan Tukar Shift ".$pihak_1->nama_lengkap." kepada " .$pihak_2->nama_lengkap. " pada tanggal ". $tgl_appv_tukar_shift . " dengan rincian jadwal ".$pihak_1->nama_lengkap. " seharusnya | ". $dt_tukar_shift->awal_jam_kerja . " menjadi " . $dt_tukar_shift->ubah_jam_kerja ." di setujui ";
                $notifikasi->user_id_penerima    = $dt_user_yang_mengajukan->id_user;
                $notifikasi->status              = 0;
                $notifikasi->save();

            }
            alert()->success('Approve Lembur Khusus Berhasil','Terima Kasih');
            return redirect()->back();
        }

        //KAJAGA
        elseif(auth()->user()->id_level_user == 7){

            //TAHAP 2
            if($cek_data->apv_kajaga_p1 === null)
            {
                TukarShift::where('id_tukar_shift',$id)->update([
                    'apv_kajaga_p1' => auth()->user()->nik,
                ]);

                $notifikasi                         = new Notifikasi();
                $notifikasi->kategori_notifikasi    = "Pengajuan";
                $notifikasi->judul_notifikasi       = "Pengajuan Tukar Shift";
                $notifikasi->isi_notifikasi         = $pihak_1->nama_lengkap." mengajukan Tukar Shift kepada " .$pihak_2->nama_lengkap. " pada tanggal ". $tgl_appv_tukar_shift . " dengan rincian jadwal ".$pihak_1->nama_lengkap. " seharusnya | ". $dt_tukar_shift->awal_jam_kerja . " menjadi " . $dt_tukar_shift->ubah_jam_kerja ." perlu persetujuan dari ".$kajaga_pihak_2->nama_lengkap;
                $notifikasi->user_id_penerima       = $dt_user_penerima_tahap_3->id_user;
                $notifikasi->status                 = 0;
                $notifikasi->save();
            }
            //TAHAP 3
            elseif($cek_data->apv_kajaga_p2 === null)
            {
                TukarShift::where('id_tukar_shift',$id)->update([
                    'apv_kajaga_p2' => auth()->user()->nik,
                    'terbit' => 1,
                ]);

                $notifikasi                      = new Notifikasi();
                $notifikasi->kategori_notifikasi = "Approve";
                $notifikasi->judul_notifikasi    = "Approve Tukar Shift";
                $notifikasi->isi_notifikasi      = "Pengajuan Tukar Shift ".$pihak_1->nama_lengkap." kepada " .$pihak_2->nama_lengkap. " pada tanggal ". $tgl_appv_tukar_shift . " dengan rincian jadwal ".$pihak_1->nama_lengkap. " seharusnya | ". $dt_tukar_shift->awal_jam_kerja . " menjadi " . $dt_tukar_shift->ubah_jam_kerja ." di setujui ";
                $notifikasi->user_id_penerima    = $dt_user_yang_mengajukan->id_user;
                $notifikasi->status              = 0;
                $notifikasi->save();

            }
            alert()->success('Approve Lembur Khusus Berhasil','Terima Kasih');
            return redirect()->back();

        }

        //SATPAM TAHAP 1
        elseif(auth()->user()->id_level_user == 8){
            TukarShift::where('id_tukar_shift',$id)->update([
                    'apv_pihak2' => auth()->user()->nik,
                ]);

                $notifikasi                         = new Notifikasi();
                $notifikasi->kategori_notifikasi    = "Pengajuan";
                $notifikasi->judul_notifikasi       = "Pengajuan Tukar Shift";
                $notifikasi->isi_notifikasi         = $pihak_1->nama_lengkap." mengajukan Tukar Shift kepada " .$pihak_2->nama_lengkap. " pada tanggal ". $tgl_appv_tukar_shift . " dengan rincian jadwal ".$pihak_1->nama_lengkap. " seharusnya | ". $dt_tukar_shift->awal_jam_kerja . " menjadi " . $dt_tukar_shift->ubah_jam_kerja ." perlu persetujuan dari ".$kajaga_pihak_1->nama_lengkap;
                $notifikasi->user_id_penerima       = $dt_user_penerima_tahap_2->id_user;
                $notifikasi->status                 = 0;
                $notifikasi->save();

            alert()->success('Approve Lembur Khusus Berhasil','Terima Kasih');
            return redirect()->back();
        }

        //SECURITY TAHAP 1
        elseif(auth()->user()->id_level_user == 9){
            TukarShift::where('id_tukar_shift',$id)->update([
                    'apv_pihak2' => auth()->user()->nik,
                ]);

                $notifikasi                         = new Notifikasi();
                $notifikasi->kategori_notifikasi    = "Pengajuan";
                $notifikasi->judul_notifikasi       = "Pengajuan Tukar Shift";
                $notifikasi->isi_notifikasi         = $pihak_1->nama_lengkap." mengajukan Tukar Shift kepada " .$pihak_2->nama_lengkap. " pada tanggal ". $tgl_appv_tukar_shift . " dengan rincian jadwal ".$pihak_1->nama_lengkap. " seharusnya | ". $dt_tukar_shift->awal_jam_kerja . " menjadi " . $dt_tukar_shift->ubah_jam_kerja ." perlu persetujuan dari ".$kajaga_pihak_1->nama_lengkap;
                $notifikasi->user_id_penerima       = $dt_user_penerima_tahap_2->id_user;
                $notifikasi->status                 = 0;
                $notifikasi->save();

            alert()->success('Approve Lembur Khusus Berhasil','Terima Kasih');
            return redirect()->back();
        }

    }

    public function reject_tukar_shift($id)
    {

        TukarShift::where('id_tukar_shift',$id)->update([
            'reject' => 1,
            'reject_by' => auth()->user()->nik
        ]);

        $data_tukar_shift = DB::table('tukar_shifts')->where('id_tukar_shift',$id)->first();

        $tgl_ts = date("d-m-Y", strtotime($data_tukar_shift->tgl_tukar));

        $dt_nama_reject = DB::table('karyawans')->where('nik',auth()->user()->nik)->first();

        $dt_user_penerima = DB::table('users')->where('nik', $data_tukar_shift->nik_pihak1)->first();

        $notifikasi                      = new Notifikasi();
        $notifikasi->kategori_notifikasi = "Reject";
        $notifikasi->judul_notifikasi    = "Pengajuan Tukar Shift Ditolak";
        $notifikasi->isi_notifikasi      = "Pengajuan Tukar Shift pada tanggal " .$tgl_ts. " di Tolak oleh ".$dt_nama_reject->nama_lengkap ;
        $notifikasi->user_id_penerima    = $dt_user_penerima->id_user;
        $notifikasi->status              = 0;
        $notifikasi->save();

        alert()->success('Reject Tukar Shift Berhasil','Terima Kasih');
        return redirect()->back();

    }

    public function struktur()
    {
        $vp = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',1)->first();

        $avp_opsmin = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',2)->first();

        $avp_kawasan = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',3)->first();

        $avp_pabrik = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',4)->first();

        $spv_security = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',5)->first();

        $spv_zona_1 = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',6)->first();
        $spv_zona_2 = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',7)->first();
        $spv_zona_3 = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',8)->first();
        $spv_zona_4 = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',9)->first();
        $spv_zona_5 = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',10)->first();

        $spv_tuks = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',11)->first();

        $spv_kawasan = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',12)->first();

        $foreman_tuks = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',16)->first();

        $foreman_security_a = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',22)->first();

        $foreman_security_b = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',23)->first();

        $foreman_security_c = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',24)->first();

        $foreman_security_d = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',25)->first();

        $staff_opsmin = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',13)->first();
        $staff_kib = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',14)->first();
        $staff_penyelidik = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',15)->get();
        $staff_zona_1 = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',17)->first();
        $staff_zona_2 = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',18)->first();
        $staff_zona_3 = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',19)->first();
        $staff_zona_4 = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',20)->first();
        $staff_zona_5 = DB::table('karyawans')
            ->join('jabatans', 'jabatans.id_jabatan', '=', 'karyawans.id_jabatan')
            ->where('karyawans.id_jabatan',21)->first();

        $jumlah_kar_organik = DB::table('karyawans')->where('pt','=','PG')->where('status_aktif',1)->count();
        $jumlah_kar_non_organik_ajg = DB::table('karyawans')->where('pt','=','AJG')->where('status_aktif',1)->count();
        $jumlah_kar_non_organik_fjm = DB::table('karyawans')->where('pt','=','FJM')->where('status_aktif',1)->count();
        $jumlah_kar_non_organik = $jumlah_kar_non_organik_ajg + $jumlah_kar_non_organik_fjm;

        return view('absensi/struktur',
            [
                'vp'=>$vp,
                'avp_opsmin'=>$avp_opsmin,
                'avp_kawasan'=>$avp_kawasan,
                'avp_pabrik'=>$avp_pabrik,
                'spv_security'=>$spv_security,
                'spv_zona_1'=>$spv_zona_1,
                'spv_zona_2'=>$spv_zona_2,
                'spv_zona_3'=>$spv_zona_3,
                'spv_zona_4'=>$spv_zona_4,
                'spv_zona_5'=>$spv_zona_5,
                'spv_tuks'=>$spv_tuks,
                'spv_kawasan'=>$spv_kawasan,
                'foreman_tuks'=>$foreman_tuks,
                'foreman_security_a'=>$foreman_security_a,
                'foreman_security_b'=>$foreman_security_b,
                'foreman_security_c'=>$foreman_security_c,
                'foreman_security_d'=>$foreman_security_d,
                'staff_opsmin'=>$staff_opsmin,
                'staff_kib'=>$staff_kib,
                'staff_penyelidik'=>$staff_penyelidik,
                'staff_zona_1'=>$staff_zona_1,
                'staff_zona_2'=>$staff_zona_2,
                'staff_zona_3'=>$staff_zona_3,
                'staff_zona_4'=>$staff_zona_4,
                'staff_zona_5'=>$staff_zona_5,
                'jumlah_kar_organik'=>$jumlah_kar_organik,
                'jumlah_kar_non_organik'=>$jumlah_kar_non_organik,
            ]);
    }

}
