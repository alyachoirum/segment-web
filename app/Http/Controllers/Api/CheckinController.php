<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\AbsensiLog;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Karyawan;
use App\Models\PresensiLog;
use Symfony\Component\HttpFoundation\Response;
use App\Models\JadwalShift;
use App\Models\Zona;
use App\Models\Regu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notifikasi;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

use function PHPUnit\Framework\isNull;

class CheckinController extends Controller
{
    public function get_user(Request $request)
    {
        $response = Karyawan::with([
                    'user:nik,email,foto,id_level_user',
                    'regu:id_regu,nama_regu',
                    'zona:id_zona,nama_zona',
                    'jabatan:id_jabatan,nama_jabatan,direct_jab_atasan,direct_jab_atasan_2',
                    'jabatan.atasan_1.user'
                    ])
                    ->where('id_karyawan', $request->id_karyawan)
                    ->first();


        $tanggal    = Carbon::now()->isoFormat('D');
        $bulan      = Carbon::now()->isoFormat('M');
        $tahun      = Carbon::now()->isoFormat('Y');
        $campur = Carbon::now()->format('Y-m-d');
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


        return response()->json([
            'karyawan' => $response,
            'jadwal' => $jadwal,
        ]);
    }
    public function check_in(Request $request)
    {

        $datenow = Carbon::now();

        if($request->jadwal_kerja == "OFF"){
            $absensi                        = new PresensiLog();
            $absensi->nik                   = $request->niknik;
            $absensi->tanggal               = $datenow;
            $absensi->jadwal_kerja          = $request->jadwal_kerja;
            $absensi->id_zona               = $request->id_zona;
            $absensi->id_regu               = $request->id_regu;
            $absensi->id_jabatan            = $request->id_jabatan;
            $absensi->status                = "off_duty";
            $absensi->save();
        }
        else{
            $absensi                        = new PresensiLog();
            $absensi->nik                   = $request->niknik;
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
            $notifikasi->isi_notifikasi      = "Karyawan ". $request->nama_lengkap. " telah check in";
            $notifikasi->user_id_penerima    = $request->user_id_penerima;
            $notifikasi->status              = 0;
            $notifikasi->save();

        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Checkin',

        ], Response::HTTP_OK);
    }

    public function checklist_presensi(Request $request)
    {
        $checkin = DB::table('presensi_logs')->where('nik', $request->nik)->whereDate('tanggal',date('Y-m-d'))->where(function($q){
            $q->whereNotNull('check_in')->orWhere('status','=','off_duty');
        })->first();

        $checkout = DB::table('presensi_logs')->where('nik', $request->nik)->whereDate('tanggal',date('Y-m-d'))->where('status','!=','off_duty')->first();

        return response()->json([
            'checkin' => is_null($checkin) ? true : false,
            'checkout' => is_null($checkout) ? false : true,
        ], Response::HTTP_OK);
    }

    public function checklist_jammasuk(Request $request)
    {
        $jammasuk = DB::table('presensi_logs')->where('nik', $request->nik)->latest('id_presensi')->first();

        return response()->json(
            $jammasuk
        , Response::HTTP_OK);
    }

    public function check_out(Request $request)
    {
        //Waktu keluar karyawan
        $checkout = Carbon::now();
        $validasi = PresensiLog::where('id_presensi',$request->id_presensi)->update([
            'check_out' => $checkout,
            'status' => "off_duty"
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Checkout',

        ], Response::HTTP_OK);
    }
}
