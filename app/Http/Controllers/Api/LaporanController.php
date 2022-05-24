<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\LaporanBukti;
use App\Models\Kategori;
use App\Models\Departemen;
use App\Models\Berita;
use App\Models\Zona;
use Illuminate\Support\Facades\Validator;

class LaporanController extends Controller
{
    public function store(Request $request){
        $data = $request->only(
            'nik', 
            'id_departemen', 
            'judul_laporan',
            'id_kategori',
            'prioritas',
            'lat',
            'lng',
            'id_zona',
            'tgl_waktu_kejadian',
            'kronologi_kejadian',
            'akibat_kejadian',
            'bantuan_pengamanan',
            'foto'
        );
        
        $validator = Validator::make($data, [
            'nik'=> 'required',
            'id_departemen'=> 'required',
            'judul_laporan'=> 'required',
            'id_kategori'=> 'required',
            'prioritas'=> 'required',
            'lat'=> 'required',
            'lng'=> 'required',
            'id_zona'=> 'required',
            'tgl_waktu_kejadian'=> 'required',
            'kronologi_kejadian'=> 'required',
            'akibat_kejadian'=> 'required',
            'bantuan_pengamanan'=> 'required',
            'foto' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Kolom isian tidak lengkap',
            ], 400);
        }
    try{
        $laporan                   = new Laporan();
        $laporan->nik              = $request->nik;
        $laporan->id_departemen    = $request->id_departemen;
        $laporan->judul_laporan    = $request->judul_laporan;
        $laporan->id_kategori      = $request->id_kategori;
        $laporan->prioritas        = $request->prioritas;
        $laporan->tingkat          = 1;
        $laporan->lat              = $request->lat;
        $laporan->lng              = $request->lng;
        $laporan->id_zona          = $request->id_zona;
        $zona = Zona::where('id_zona',$request->id_zona)->first();
        $laporan->klasifikasi_zona = $zona->nama_zona;
        $departemen = Departemen::where('id_departemen',$request->id_departemen)->first();
        $laporan->unit_kerja       = $departemen->nama_departemen;
        $laporan->tgl_waktu_kejadian = $request->tgl_waktu_kejadian;
        $laporan->kronologi_kejadian = $request->kronologi_kejadian;
        $laporan->akibat_kejadian = $request->akibat_kejadian;
        $laporan->bantuan_pengamanan = $request->bantuan_pengamanan;
        // $laporan->deskripsi        = $request->deskripsi;
        $laporan->save();
        // dd($laporan->tingkat);

        //data foto dalam bentuk array base64
        $foto = json_decode($request->foto);

        for($i = 0; $i < count($foto) ; $i++){
            $name = time().$i.".jpg";
            $path = public_path()."/foto/laporan".$name;
            file_put_contents($path, base64_decode($foto[$i]));

            $lokasi_penyimpanan = $name;

            $insertDB = LaporanBukti::create([
                'id_laporan' => $laporan->id_laporan,
                'foto' => $lokasi_penyimpanan
            ]);
        }

        return response()->json([
            'success'=>true,
            'message'   =>'Berhasil menambahkan laporan'
        ], 201);
    }
        catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Terjadi Kesalahan',
            ], 400);
        }
    }

    public function create()
    {
        return response()->json([
            'kategori' => Kategori::get(),
            'prioritas' => ["Normal","Medium","High","Urgent"],
            'zona' => Zona::get(),
        ]);
    }

    public function pencarian(Request $request)
    {
        return response()->json(
            Laporan::with('user.karyawan')->where('judul_laporan','LIKE','%'.$request->keyword.'%')->get()
        );
    }

    public function all(Request $request){
        return response()->json(
            Laporan::with('user.karyawan')->with('laporan_bukti')->where('publish',1)->get()
        );
    }

    public function by_user(Request $request){
        return response()->json(
            Laporan::with('user.karyawan')->with('laporan_bukti')->where('nik',$request->nik)->get()
        );
    }

    public function status_laporan(Request $request){
        $menunggu = Laporan::where('nik',$request->nik)->where('tingkat',1)->get();
        $menunggu2 = Laporan::where('nik',$request->nik)->where('tingkat',2)->get();
        $proses = Laporan::where('nik',$request->nik)->where('tingkat',3)->get();
        $selesai = Laporan::where('nik',$request->nik)->where('tingkat',4)->get();
        return response()->json([
            'menunggu' => count($menunggu)+count($menunggu2),
            'proses' => count($proses),
            'selesai' => count($selesai)
        ],200);
    }

    public function berita(){
        return response()->json(
            Berita::with('user.karyawan')->get()
        );
    }



}
