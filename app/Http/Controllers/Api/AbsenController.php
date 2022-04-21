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

    public function list_absen(Request $request)
    {
        //need tipe, nik
        if($request->tipe == 0){ //belum validasi
            $data = AbsensiLog::where('nik', $request->nik)->where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }else if($request->tipe == 1){ //sudah divalidasi
            $data = AbsensiLog::where('nik', $request->nik)->where('terbit',1)->where('reject',0)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }else{ //ditolak
            $data = AbsensiLog::where('nik', $request->nik)->where('terbit',0)->where('reject',1)->with('karyawan')->orderBy('tgl_absen', 'desc')->get();
        }
        // dd(count($data));
        return response()->json($data);
    }
    public function list_absen_detail(Request $request){
        $data = AbsensiLog::where('id_absensi',$request->id_absensi)->first();
        return response()->json($data);
    }

    public function list_lembur(Request $request)
    {
        // dd("ok");
        //need tipe, nik
        if($request->tipe == 0){ //belum validasi
            $data = Lembur::where('nik', $request->nik)->where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }else if($request->tipe == 1){ //sudah divalidasi
            $data = Lembur::where('nik', $request->nik)->where('terbit',1)->where('reject',0)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }else{ //ditolak
            $data = Lembur::where('nik', $request->nik)->where('terbit',0)->where('reject',1)->with('karyawan')->orderBy('tgl_lembur', 'desc')->get();
        }
        // dd(count($data));
        return response()->json($data);
    }
    public function list_lembur_detail(Request $request){
        $data = Lembur::where('id_lembur',$request->id_lembur)->first();
        return response()->json($data);
    }

    public function list_lembur_khusus(Request $request)
    {
        //need tipe, nik
        if($request->tipe == 0){ //belum validasi
            $data = LemburKhusus::where('nik', $request->nik)->where('terbit',0)->where('reject',0)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }else if($request->tipe == 1){ //sudah divalidasi
            $data = LemburKhusus::where('nik', $request->nik)->where('terbit',1)->where('reject',0)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }else{ //ditolak
            $data = LemburKhusus::where('nik', $request->nik)->where('terbit',0)->where('reject',1)->with('karyawan')->orderBy('tgl_lembur_khusus', 'desc')->get();
        }
        // dd(count($data));
        return response()->json($data);
    }
    public function list_lembur_khusus_detail(Request $request){
        $data = LemburKhusus::where('id_lembur_khusus',$request->id_lembur_khusus)->first();
        return response()->json($data);
    }

    public function data_jadwal(Request $request){

        $pattern = ['S','S','OFF','M','M','OFF','P','P','P','S','S','OFF','M','M','M','OFF','P','P','S','S','OFF','OFF','M','M','OFF','P','P','S'];

        $regu_a = $pattern;
        $regu_b = array_merge(array_slice($pattern,21), array_slice($pattern,0,21));
        $regu_c = array_merge(array_slice($pattern,7), array_slice($pattern,0,7));
        $regu_d = array_merge(array_slice($pattern,14), array_slice($pattern,0,14));

        $en = Carbon::now()->locale('en_US');

        $tanggal = strtotime("2 january 2022");
        // dd($en);

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

        dd($getdata);

        return response()->json(
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

    public function get_jadwal(Request $request){
        $jadwal = JadwalShift::where('bulan',$request->bulan)
                ->where('tahun',$request->tahun)
                ->where('id_regu', $request->id_regu)->get();
        $action = $jadwal[0]->action;
        $jam_masuk = $jadwal[0]->jam_masuk;
        $jam_keluar = $jadwal[0]->jam_keluar;

        $jadwale = "|$action| $jam_masuk - $jam_keluar";
        return response()->json($jadwal);
    }


}
