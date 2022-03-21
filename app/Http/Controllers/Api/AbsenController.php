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
use App\Models\Lembur;
use App\Models\LemburKhusus;
use App\Models\Notifikasi;
use App\Models\Zona;
use App\Models\Regu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

use function PHPUnit\Framework\isNull;

class AbsenController extends Controller
{
    public function cuti_submit(Request $request)
    {
        try{
            $absensi                        = new AbsensiLog();
            $absensi->nik                   = $request->nik;
            $absensi->tgl_absen             = $request->tgl_absen;
            $absensi->tipe_absen            = $request->tipe_absen;
            $absensi->detail                = $request->detail_absen;
            $absensi->terbit                = "0";
            $absensi->reject                = "0";
            $absensi->save();

            $tgl = $request->tgl_absen;
            $tgl_tdk_msk = date("d-m-Y", strtotime($tgl));

            $notifikasi                      = new Notifikasi();
            $notifikasi->kategori_notifikasi = "Pengajuan";
            $notifikasi->judul_notifikasi    = "Pengajuan Cuti";
            $notifikasi->isi_notifikasi      = $request->nama_lengkap. " Mengajukan Cuti Tidak Masuk Kerja pada tanggal " .$tgl_tdk_msk;
            $notifikasi->user_id_penerima    = $request->user_id_penerima;
            $notifikasi->status              = 0;
            $notifikasi->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil Submit Form Cuti',

            ], Response::HTTP_OK);

        }
        catch(\Exception $e){
            return response()->json($e, 400);
        }
    }

    public function dispensasi_submit(Request $request)
    {
        try{
            $absensi                        = new AbsensiLog();
            $absensi->nik                   = $request->nik;
            $absensi->tgl_absen             = $request->tgl_absen;
            $absensi->tipe_absen            = $request->tipe_absen;
            $absensi->detail                = $request->detail_absen;
            $absensi->terbit                = "0";
            $absensi->reject                = "0";
            $absensi->save();

            $tgl = $request->tgl_absen;
            $tgl_tdk_msk = date("d-m-Y", strtotime($tgl));

            $notifikasi                      = new Notifikasi();
            $notifikasi->kategori_notifikasi = "Pengajuan";
            $notifikasi->judul_notifikasi    = "Pengajuan Dispensasi";
            $notifikasi->isi_notifikasi      = $request->nama_lengkap. " Mengajukan Dispensasi Tidak Masuk Kerja pada tanggal " .$tgl_tdk_msk;
            $notifikasi->user_id_penerima    = $request->user_id_penerima;
            $notifikasi->status              = 0;
            $notifikasi->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil Submit Form Dispensasi',

            ], Response::HTTP_OK);

        }
        catch(\Exception $e){
            return response()->json($e, 400);
        }
    }

    public function ijin_submit(Request $request)
    {
        try{
            $absensi                        = new AbsensiLog();
            $absensi->nik                   = $request->nik;
            $absensi->tgl_absen             = $request->tgl_absen;
            $absensi->tipe_absen            = $request->tipe_absen;
            $absensi->detail                = $request->detail_absen;
            $absensi->terbit                = "0";
            $absensi->reject                = "0";
            $absensi->save();

            $tgl = $request->tgl_absen;
            $tgl_tdk_msk = date("d-m-Y", strtotime($tgl));

            $notifikasi                      = new Notifikasi();
            $notifikasi->kategori_notifikasi = "Pengajuan";
            $notifikasi->judul_notifikasi    = "Pengajuan Ijin";
            $notifikasi->isi_notifikasi      = $request->nama_lengkap. " Mengajukan Ijin Tidak Masuk Kerja pada tanggal " .$tgl_tdk_msk;
            $notifikasi->user_id_penerima    = $request->user_id_penerima;
            $notifikasi->status              = 0;
            $notifikasi->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil Submit Form Ijin',

            ], Response::HTTP_OK);

        }
        catch(\Exception $e){
            return response()->json($e, 400);
        }
    }

    public function sakit_submit(Request $request)
    {
        try{
            $foto = $request->foto;

            $name = time().".jpg";
            $path = public_path()."/assets/foto_bukti_sakit/".$name;
            file_put_contents($path, base64_decode($foto));

            $lokasi_penyimpanan = $name;

            $absensi                        = new AbsensiLog();
            $absensi->nik                   = $request->nik;
            $absensi->tgl_absen             = $request->tgl_absen;
            $absensi->tipe_absen            = $request->tipe_absen;
            $absensi->detail                = $request->detail_absen;
            $absensi->bukti                 = $lokasi_penyimpanan;
            $absensi->validasi              = null;
            $absensi->mengetahui            = null;
            $absensi->terbit                = "0";
            $absensi->reject                = "0";
            $absensi->save();

            $tgl = $request->tgl_absen;
            $tgl_tdk_msk = date("d-m-Y", strtotime($tgl));

            $notifikasi                      = new Notifikasi();
            $notifikasi->kategori_notifikasi = "Pengajuan";
            $notifikasi->judul_notifikasi    = "Pengajuan Sakit";
            $notifikasi->isi_notifikasi      = $request->nama_lengkap. " Mengajukan Sakit Tidak Masuk Kerja pada tanggal " .$tgl_tdk_msk;
            $notifikasi->user_id_penerima    = $request->user_id_penerima;
            $notifikasi->status              = 0;
            $notifikasi->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil Submit Form Sakit',

            ], Response::HTTP_OK);

        }
        catch(\Exception $e){
            return response()->json($e, 400);
        }

    }

    public function lembur_submit(Request $request)
    {
        try{
            $lembur                        = new Lembur();
            $lembur->nik                   = $request->nik;
            $lembur->tgl_lembur            = $request->tgl_lembur;
            $lembur->total_jam_lembur      = $request->total_jam_lembur;
            $lembur->detail_lembur         = $request->detail_lembur;
            $lembur->terbit                = "0";
            $lembur->reject                = "0";
            $lembur->save();

            $tgl = $request->tgl_lembur;
            $tgl_tdk_msk = date("d-m-Y", strtotime($tgl));

            $notifikasi                      = new Notifikasi();
            $notifikasi->kategori_notifikasi = "Pengajuan";
            $notifikasi->judul_notifikasi    = "Pengajuan Lembur";
            $notifikasi->isi_notifikasi      = $request->nama_lengkap. " Mengajukan SPL pada tanggal " .$tgl_tdk_msk;
            $notifikasi->user_id_penerima    = $request->user_id_penerima;
            $notifikasi->status              = 0;
            $notifikasi->save();

            return response()->json([
                'success' => true,
                'message' => 'Berhasil Submit Form SPL Lembur',

            ], Response::HTTP_OK);

        }
        catch(\Exception $e){
            return response()->json($e, 400);
        }
    }

    public function lemburkhusus_submit(Request $request)
    {
        $id_zona = $request->nama_zona;

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

        try{
            $lembur_khusus                          = new LemburKhusus();
            $lembur_khusus->nik                     = $request->nik;
            $lembur_khusus->tgl_lembur_khusus       = $request->tgl_lembur_khusus;
            $lembur_khusus->total_jam_lembur_khusus = $request->total_jam_lembur_khusus;
            $lembur_khusus->klasifikasi_zona        = $zona;
            $lembur_khusus->detail_lembur_khusus    = $request->detail_lembur_khusus;
            $lembur_khusus->terbit                  = "0";
            $lembur_khusus->reject                  = "0";
            $lembur_khusus->save();

            $tgl = $request->tgl_lembur_khusus;
            $tgl_tdk_msk = date("d-m-Y", strtotime($tgl));

            $notifikasi                      = new Notifikasi();
            $notifikasi->kategori_notifikasi = "Pengajuan";
            $notifikasi->judul_notifikasi    = "Pengajuan Lembur Khusus";
            $notifikasi->isi_notifikasi      = $request->nama_lengkap. " Mengajukan Lembur Khusus pada tanggal " .$tgl_tdk_msk;
            $notifikasi->user_id_penerima    = $request->user_id_penerima;
            $notifikasi->status              = 0;
            $notifikasi->save();


            return response()->json([
                'success' => true,
                'message' => 'Berhasil Submit Form Lembur Khusus',

            ], Response::HTTP_OK);

        }
        catch(\Exception $e){
            return response()->json($e, 400);
        }
    }

}
