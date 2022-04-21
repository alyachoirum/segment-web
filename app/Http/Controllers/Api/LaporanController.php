<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\LaporanBukti;
use App\Models\Kategori;
use App\Models\Departemen;
use Illuminate\Support\Facades\Validator;

class LaporanController extends Controller
{
    public function store(Request $request){
        // dd($request->tingkat);
        // dd($request->id_departemen);
        // $departemen = Departemen::where()
    try{
        $laporan                   = new Laporan();
        // $laporan->tanggal          = $request->tanggal;
        $laporan->judul_laporan    = $request->judul_laporan;
        $laporan->id_kategori      = $request->id_kategori;
        $laporan->prioritas        = $request->prioritas;
        // $laporan->deskripsi        = $request->deskripsi;
        $laporan->tingkat          = $request->tingkat;
        $laporan->id_departemen    = $request->id_departemen;
        $laporan->appv1            = $request->appv1 == "" ? null : $request->appv1;
        $laporan->appv2            = $request->appv2 == "" ? null : $request->appv2;
        $laporan->appv3            = $request->appv3 == "" ? null : $request->appv3;
        $laporan->id_zona          = $request->id_zona == "" ? null : $request->id_zona;
        $laporan->publish          = $request->publish;
        $laporan->nik              = $request->nik;
        $laporan->lat              = $request->lat;
        $laporan->lng              = $request->lng;
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
            'succes'=>true,
            'msg'   =>'Berhasil menambahkan laporan'
        ], 201);
    }
        catch(\Exception $e){
            return response()->json($e, 400);
        }
    }

    public function create()
    {
        return response()->json([
            'kategori' => Kategori::get(),
            'prioritas' => ["Normal","Medium","High","Urgent"]
        ]);
    }

    public function pencarian(Request $request)
    {
        return response()->json(
            Laporan::where('judul_laporan','LIKE','%'.$request->keyword.'%')->get()
        );
    }



}
