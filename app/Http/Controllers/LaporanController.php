<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Laporan;
use App\Models\LaporanBukti;
use App\Models\Kategori;


class LaporanController extends Controller
{
    public function data_laporan_publish(Request $request){

        // $dt_laporan_publish = DB::table('laporans')
        //                 ->join('kategoris','kategoris.id_kategori', '=', 'laporans.id_kategori')
        //                 ->join('users','users.nik', '=', 'laporans.nik')
        //                 ->join('karyawans','karyawans.nik', '=', 'laporans.nik')
        //                 ->select('laporans.id_laporan','laporans.judul_laporan','kategoris.nama_kategori','laporans.prioritas',
        //                 'laporans.tingkat','laporans.appv1','laporans.appv2','laporans.appv3',
        //                 'laporans.tingkat','laporans.publish','laporans.lat','laporans.lng','laporans.kronologi_kejadian','laporans.created_at',
        //                 'karyawans.nama_lengkap','users.foto')
        //                 ->where('laporans.publish', 1)
        //                 ->orderBy('laporans.created_at', 'desc')
        //                 ->get();

        $dt_laporan_publish = DB::table('laporans')

                        ->get();

        // $response = Karyawan::where('id_karyawan', $id)
        //             ->with(['user:nik,email,foto','regu:id_regu,nama_regu','zona:id_zona,nama_zona','jabatan:id_jabatan,nama_jabatan'])
        //             ->first();

        // $dt_laporan_publish = $dt_laporan_publish->unique('id_laporan');

        $dt_laporan_foto = DB::table('laporan_buktis')->get();

        // $tes = Laporan::all();

        return view('pelaporan/laporan_publish',
            [
                'data_laporan' => $dt_laporan_publish,
                'foto' => $dt_laporan_foto
            ]);
    }

    public function detail_laporan(Request $request)
    {
        // $detail = DB::table('laporans')
        //                 ->join('kategoris','kategoris.id_kategori', '=', 'laporans.id_kategori')
        //                 ->join('users','users.nik', '=', 'laporans.nik')
        //                 ->join('karyawans','karyawans.nik', '=', 'laporans.nik')
        //                 ->join('laporan_buktis', 'laporan_buktis.id_laporan', '=', 'laporans.id_laporan')
        //                 ->select('laporan_buktis.id_laporan','laporans.judul_laporan','kategoris.nama_kategori','laporans.prioritas',
        //                 'laporans.tingkat','laporans.id_departemen','laporans.appv1','laporans.appv2','laporans.appv3',
        //                 'laporans.tingkat','laporans.publish','laporans.lat','laporans.lng','laporans.kronologi_kejadian','laporans.created_at',
        //                 'karyawans.nama_lengkap','users.foto')
        //                 ->where('laporans.id_laporan', $request->id_laporan)
        //                 ->first();
        $detail = DB::table('laporans')
                        ->where('id_laporan', $request->id_laporan)
                        ->first();

        $dt_laporan_foto = DB::table('laporan_buktis')
                        ->where('id_laporan', $request->id_laporan)->get();

        return view('pelaporan/detail_laporan',
            [
                'detail' => $detail,
                'foto' => $dt_laporan_foto
            ]);
    }

    public function data_semua_laporan(){


        // $dt_laporan = DB::table('laporans')
        //                 ->join('kategoris','kategoris.id_kategori', '=', 'laporans.id_kategori')
        //                 ->join('users','users.id_user', '=', 'laporans.id_user')
        //                 ->join('laporan_buktis', 'laporan_buktis.id_laporan', '=', 'laporans.id_laporan')
        //                 ->join('users as kepala_regu', 'kepala_regu.id_user', 'laporans.appv1')
        //                 ->join('users as kepala_seksi', 'kepala_seksi.id_user', 'laporans.appv2')
        //                 ->leftjoin('users as kepala_bagian', 'kepala_bagian.id_user', 'laporans.appv3')
        //                 ->select('laporans.id_laporan','laporans.judul_laporan','kategoris.nama_kategori','laporans.prioritas',
        //                 '','laporans.tingkat','laporans.id_departemen','laporans.appv1','laporans.appv2','laporans.appv3',
        //                 'laporans.tingkat','laporans.publish','laporans.lat','laporans.lng','laporans.created_at',
        //                 'users.nama_user','laporan_buktis.foto', 'kepala_regu.nama_user as kepala_regu', 'kepala_seksi.nama_user as kepala_seksi', 'kepala_bagian.nama_user as kepala_bagian')
        //                 ->whereIn('laporans.tingkat', [1,2,3,4])
        //                 ->get();

        $dt_laporan_semua = DB::table('laporans')
                                ->join('kategoris','kategoris.id_kategori', '=', 'laporans.id_kategori')
                                ->join('users','users.nik', '=', 'laporans.nik')
                                ->join('karyawans', 'karyawans.nik','=','laporans.nik')
                                ->select('karyawans.nama_lengkap','laporans.appv1','laporans.appv2','laporans.appv3','laporans.id_laporan','laporans.nik','laporans.judul_laporan', 'kategoris.nama_kategori','laporans.prioritas', 'laporans.tingkat', 'laporans.lat', 'laporans.lng','laporans.kronologi_kejadian','laporans.created_at')
                                ->orderBy('laporans.created_at', 'desc')
                                ->get();

        return view('pelaporan/pelaporan_semua',
            [
                // 'data_laporan' => $dt_laporan,
                'data_semua_laporan' => $dt_laporan_semua
            ]);
    }

    public function data_laporan_proses1(){
        // $dt_laporan =  DB::table('laporans')
        //                 ->join('kategoris','kategoris.id_kategori', '=', 'laporans.id_kategori')
        //                 ->join('users','users.nik', '=', 'laporans.nik')
        //                 ->join('karyawans', 'karyawans.nik','=','laporans.nik')
        //                 ->join('laporan_buktis', 'laporan_buktis.id_laporan', '=', 'laporans.id_laporan')
        //                 ->select('laporan_buktis.id_laporan','laporans.judul_laporan','kategoris.nama_kategori','laporans.prioritas',
        //                 '','laporans.tingkat','laporans.id_departemen','laporans.appv1','laporans.appv2','laporans.appv3',
        //                 'laporans.tingkat','laporans.publish','laporans.lat','laporans.lng','laporans.created_at',
        //                 'karyawans.nama_lengkap','users.foto','laporan_buktis.foto',)
        //                 ->where('laporans.tingkat', 1)
        //                 ->orderBy('laporans.created_at', 'desc')
        //                 ->get();
        // $dt_laporan = $dt_laporan->unique('id_laporan');


        $dt_laporan = DB::table('laporans')
                ->join('kategoris','kategoris.id_kategori', '=', 'laporans.id_kategori')
                ->join('departemens','departemens.id_departemen', '=', 'laporans.id_departemen')
                ->join('users','users.nik', '=', 'laporans.nik')
                ->join('karyawans', 'karyawans.nik','=','laporans.nik')
                ->select('laporans.id_laporan','laporans.nik','laporans.id_departemen','laporans.judul_laporan', 'laporans.id_kategori','laporans.prioritas', 'laporans.tingkat', 'laporans.appv1','laporans.appv2','laporans.appv3', 'laporans.publish', 'laporans.lat','laporans.lng','laporans.created_at'
                        ,'karyawans.nama_lengkap','kategoris.nama_kategori','users.foto','departemens.nama_departemen')
                ->where('laporans.tingkat', 1)
                ->get();

        $dt_laporan = $dt_laporan->unique('id_laporan');


        return view('pelaporan/pelaporan_proses1',
            [
                'data_laporan' => $dt_laporan,
            ]);
    }

    public function data_laporan_proses2(){
        // $dt_laporan = DB::table('laporans')
        //                 ->join('kategoris','kategoris.id_kategori', '=', 'laporans.id_kategori')
        //                 ->join('users','users.nik', '=', 'laporans.nik')
        //                 ->join('karyawans', 'karyawans.nik','=','laporans.nik')
        //                 ->join('karyawans as appv1', 'appv1.id_karyawan',  'laporans.appv1')
        //                 ->leftjoin('karyawans as appv2', 'appv2.id_karyawan', 'laporans.appv2')
        //                 ->join('laporan_buktis', 'laporan_buktis.id_laporan', '=', 'laporans.id_laporan')
        //                 ->select('laporans.id_laporan','laporans.judul_laporan','kategoris.nama_kategori','laporans.prioritas',
        //                 '','laporans.tingkat','laporans.id_departemen','laporans.appv1','laporans.appv2','laporans.appv3',
        //                 'laporans.tingkat','laporans.publish','laporans.lat','laporans.lng','laporans.created_at',
        //                 'karyawans.nama_lengkap','laporan_buktis.foto', 'appv1.nama_lengkap as appv1', 'appv2.nama_lengkap as appv2')
        //                 ->where('laporans.tingkat', 2)
        //                 ->orderBy('laporans.created_at', 'desc')
        //                 ->get();

        // $dt_laporan = $dt_laporan->unique('id_laporan');

        $dt_laporan = DB::table('laporans')
                ->join('kategoris','kategoris.id_kategori', '=', 'laporans.id_kategori')
                ->join('departemens','departemens.id_departemen', '=', 'laporans.id_departemen')
                ->join('users','users.nik', '=', 'laporans.nik')
                ->join('karyawans', 'karyawans.nik','=','laporans.nik')
                ->select('laporans.id_laporan','laporans.nik','laporans.id_departemen','laporans.judul_laporan', 'laporans.id_kategori','laporans.prioritas', 'laporans.tingkat', 'laporans.appv1','laporans.appv2','laporans.appv3', 'laporans.publish', 'laporans.lat','laporans.lng','laporans.created_at'
                        ,'karyawans.nama_lengkap','kategoris.nama_kategori','users.foto','departemens.nama_departemen')
                ->where('laporans.tingkat', 2)
                ->get();

        $dt_laporan = $dt_laporan->unique('id_laporan');

        return view('pelaporan/pelaporan_proses2',
            [
                'data_laporan' => $dt_laporan
            ]);
    }

    public function data_laporan_proses3(){
        // $dt_laporan = DB::table('laporans')
        //                 ->join('kategoris','kategoris.id_kategori', '=', 'laporans.id_kategori')
        //                 ->join('users','users.nik', '=', 'laporans.nik')
        //                 ->join('karyawans', 'karyawans.nik','=','laporans.nik')
        //                 ->join('karyawans as appv1', 'appv1.id_karyawan',  'laporans.appv1')
        //                 ->join('karyawans as appv2', 'appv2.id_karyawan', 'laporans.appv2')
        //                 ->leftjoin('karyawans as appv3', 'appv3.id_karyawan', 'laporans.appv3')
        //                 ->join('laporan_buktis', 'laporan_buktis.id_laporan', '=', 'laporans.id_laporan')
        //                 ->select('laporans.id_laporan','laporans.judul_laporan','kategoris.nama_kategori','laporans.prioritas',
        //                 '','laporans.tingkat','laporans.id_departemen','laporans.appv1','laporans.appv2','laporans.appv3',
        //                 'laporans.tingkat','laporans.publish','laporans.lat','laporans.lng','laporans.created_at',
        //                 'karyawans.nama_lengkap','laporan_buktis.foto', 'appv1.nama_lengkap as appv1', 'appv2.nama_lengkap as appv2', 'appv3.nama_lengkap as appv3')
        //                 ->where('laporans.tingkat', 3)
        //                 ->orderBy('laporans.created_at', 'desc')
        //                 ->get();

        // $dt_laporan = $dt_laporan->unique('id_laporan');

        $dt_laporan = DB::table('laporans')
                ->join('kategoris','kategoris.id_kategori', '=', 'laporans.id_kategori')
                ->join('departemens','departemens.id_departemen', '=', 'laporans.id_departemen')
                ->join('users','users.nik', '=', 'laporans.nik')
                ->join('karyawans', 'karyawans.nik','=','laporans.nik')
                ->select('laporans.id_laporan','laporans.nik','laporans.id_departemen','laporans.judul_laporan', 'laporans.id_kategori','laporans.prioritas', 'laporans.tingkat', 'laporans.appv1','laporans.appv2','laporans.appv3', 'laporans.publish', 'laporans.lat','laporans.lng','laporans.created_at'
                        ,'karyawans.nama_lengkap','kategoris.nama_kategori','users.foto','departemens.nama_departemen')
                ->where('laporans.tingkat', 3)
                ->get();
        $dt_laporan = $dt_laporan->unique('id_laporan');

        return view('pelaporan/pelaporan_proses3',
            [
                'data_laporan' => $dt_laporan
            ]);
    }


    public function data_laporan_selesai(){
        // $dt_laporan = DB::table('laporans')
        //                 ->join('kategoris','kategoris.id_kategori', '=', 'laporans.id_kategori')
        //                 ->join('users','users.nik', '=', 'laporans.nik')
        //                 ->join('karyawans', 'karyawans.nik','=','laporans.nik')
        //                 ->join('karyawans as appv1', 'appv1.id_karyawan',  'laporans.appv1')
        //                 ->join('karyawans as appv2', 'appv2.id_karyawan', 'laporans.appv2')
        //                 ->leftjoin('karyawans as appv3', 'appv3.id_karyawan', 'laporans.appv3')
        //                 ->join('laporan_buktis', 'laporan_buktis.id_laporan', '=', 'laporans.id_laporan')
        //                 ->select('laporans.id_laporan','laporans.judul_laporan','kategoris.nama_kategori','laporans.prioritas',
        //                 '','laporans.tingkat','laporans.id_departemen','laporans.appv1','laporans.appv2','laporans.appv3',
        //                 'laporans.tingkat','laporans.publish','laporans.lat','laporans.lng','laporans.created_at',
        //                 'karyawans.nama_lengkap','laporan_buktis.foto', 'appv1.nama_lengkap as appv1', 'appv2.nama_lengkap as appv2', 'appv3.nama_lengkap as appv3')
        //                 ->where('laporans.tingkat', 4)
        //                 ->orderBy('laporans.created_at', 'desc')
        //                 ->get();
        // $dt_laporan = $dt_laporan->unique('id_laporan');

        $dt_laporan = DB::table('laporans')
                ->join('kategoris','kategoris.id_kategori', '=', 'laporans.id_kategori')
                ->join('departemens','departemens.id_departemen', '=', 'laporans.id_departemen')
                ->join('users','users.nik', '=', 'laporans.nik')
                ->join('karyawans', 'karyawans.nik','=','laporans.nik')
                ->select('laporans.id_laporan','laporans.nik','laporans.id_departemen','laporans.judul_laporan', 'laporans.id_kategori','laporans.prioritas', 'laporans.tingkat', 'laporans.appv1','laporans.appv2','laporans.appv3', 'laporans.publish', 'laporans.lat','laporans.lng','laporans.kronologi_kejadian','laporans.created_at'
                        ,'karyawans.nama_lengkap','kategoris.nama_kategori','users.foto','departemens.nama_departemen')
                ->where('laporans.tingkat', 4)
                ->get();

        $dt_laporan = $dt_laporan->unique('id_laporan');


        return view('pelaporan/pelaporan_selesai',
            [
                'data_laporan' => $dt_laporan
            ]);
    }

    public function tambah_laporan_umum(Request $request)
    {
        foreach($request->file('gambar') as $img)
        {
            $name = rand().'.jpg';
            $img->move('foto/','laporan'.$name);
            $file_gambar[] = $name;
        }

        $laporan                        = new Laporan();
        // $laporan->nik                   = $request->no_identitas;
        $laporan->id_departemen         = $request->unit_kerja;
        $laporan->judul_laporan         = $request->judul_laporan;
        $laporan->id_kategori           = $request->id_kategori;
        $laporan->prioritas             = $request->prioritas;
        $laporan->tingkat               = 1;
        $laporan->appv1                 = null;
        $laporan->appv2                 = null;
        $laporan->appv3                 = null;
        $laporan->publish               = 1;
        $laporan->lat                   = $request->lat;
        $laporan->lng                   = $request->lng;
        $laporan->id_zona               = $request->id_zona;
        $laporan->unit_kerja            = $request->unit_kerja;

        $tgl = $request->tgl_kejadian;
        $tgl_kejadian = date("Y-m-d", strtotime($tgl));

        // $jam = $request->jam_kejadian;
        // $jam_kejadian = date("H:i:s", strtotime($jam));

        // $tgl_waktu_kejadian = $tgl_kejadian." ".$jam_kejadian;

        $laporan->tgl_kejadian         = $tgl_kejadian;
        $laporan->waktu_kejadian       = $request->waktu_kejadian;
        $laporan->kronologi_kejadian   = $request->kronologi_kejadian;
        $laporan->akibat_kejadian      = $request->akibat_kejadian;
        $laporan->bantuan_pengamanan   = $request->bantuan_pengamanan;
        $laporan->save();

        foreach($file_gambar as $file){
            LaporanBukti::create([
                'id_laporan' => $laporan->id_laporan,
                'foto' => $file
            ]);
        }

        return redirect('/')->with('success', 'Tambah Laporan Berhasil');
    }

    public function tambah_data_laporan()
    {
        $dt_kategori   = DB::table('kategoris')->get();
        $dt_zona       = DB::table('zonas')->get();
        $dt_departemen = DB::table('departemens')->get();

        return view('pelaporan/tambah_laporan',[
            'data_kategori'   => $dt_kategori,
            'data_zona'       => $dt_zona,
            'data_departemen' => $dt_departemen
        ]);
    }

    public function tambah_laporan(Request $request)
    {
        foreach($request->file('gambar') as $img)
        {
            $name = rand().'.jpg';
            $img->move('foto/','laporan'.$name);
            $file_gambar[] = $name;
        }

        $laporan                   = new Laporan();
        $laporan->nik              = auth()->user()->nik;
        $laporan->id_departemen    = auth()->user()->id_departemen;
        $laporan->judul_laporan    = $request->judul_laporan;
        $laporan->id_kategori      = $request->id_kategori;
        $laporan->prioritas        = $request->prioritas;

        if(auth()->user()->id_level_user == 1){
            $laporan->tingkat          = 4;
            $laporan->appv1            = auth()->user()->nik;
            $laporan->appv2            = auth()->user()->nik;
            $laporan->appv3            = auth()->user()->nik;
            $laporan->publish          = 1;
        }
        elseif(auth()->user()->id_level_user == 2){
            $laporan->tingkat          = 4;
            $laporan->appv1            = auth()->user()->nik;
            $laporan->appv2            = auth()->user()->nik;
            $laporan->appv3            = auth()->user()->nik;
            $laporan->publish          = 1;
        }
        elseif(auth()->user()->id_level_user == 3){
            $laporan->tingkat          = 4;
            $laporan->appv1            = auth()->user()->nik;
            $laporan->appv2            = auth()->user()->nik;
            $laporan->appv3            = auth()->user()->nik;
            $laporan->publish          = 1;
        }
        elseif(auth()->user()->id_level_user == 4){
            $laporan->tingkat          = 3;
            $laporan->appv1            = auth()->user()->nik;
            $laporan->appv2            = auth()->user()->nik;
            $laporan->appv3            = null;
            $laporan->publish          = 0;
        }
        elseif(auth()->user()->id_level_user == 5){
            $laporan->tingkat          = 2;
            $laporan->appv1            = auth()->user()->nik;
            $laporan->appv2            = null;
            $laporan->appv3            = null;
            $laporan->publish          = 0;
        }
        elseif(auth()->user()->id_level_user == 6){
            $laporan->tingkat          = 2;
            $laporan->appv1            = auth()->user()->nik;
            $laporan->appv2            = null;
            $laporan->appv3            = null;
            $laporan->publish          = 0;
        }
        elseif(auth()->user()->id_level_user == 7){
            $laporan->tingkat          = 2;
            $laporan->appv1            = auth()->user()->nik;
            $laporan->appv2            = null;
            $laporan->appv3            = null;
            $laporan->publish          = 0;
        }
        elseif(auth()->user()->id_level_user == 8){
            $laporan->tingkat          = 1;
            $laporan->appv1            = null;
            $laporan->appv2            = null;
            $laporan->appv3            = null;
            $laporan->publish          = 0;
        }
        elseif(auth()->user()->id_level_user == 9){
            $laporan->tingkat          = 1;
            $laporan->appv1            = null;
            $laporan->appv2            = null;
            $laporan->appv3            = null;
            $laporan->publish          = 0;
        }
        elseif(auth()->user()->id_level_user == 10){
            $laporan->tingkat          = 1;
            $laporan->appv1            = auth()->user()->nik;
            $laporan->appv2            = null;
            $laporan->appv3            = null;
            $laporan->publish          = 0;
        }
        else{
            $laporan->tingkat          = 1;
            $laporan->appv1            = null;
            $laporan->appv2            = null;
            $laporan->appv3            = null;
            $laporan->publish          = 0;
        };

        $laporan->lat                  = $request->lat;
        $laporan->lng                  = $request->lng;
        $laporan->id_zona              = $request->id_zona;
        $laporan->unit_kerja           = $request->unit_kerja;

        $tgl = $request->tgl_kejadian;
        $tgl_kejadian = date("Y-m-d", strtotime($tgl));

        $jam = $request->jam_kejadian;
        $jam_kejadian = date("H:i:s", strtotime($jam));

        $tgl_waktu_kejadian = $tgl_kejadian." ".$jam_kejadian;

        $laporan->tgl_waktu_kejadian   = $tgl_waktu_kejadian;
        $laporan->kronologi_kejadian   = $request->kronologi_kejadian;
        $laporan->akibat_kejadian      = $request->akibat_kejadian;
        $laporan->bantuan_pengamanan   = $request->bantuan_pengamanan;
        $laporan->save();

        foreach($file_gambar as $file){
            LaporanBukti::create([
                'id_laporan' => $laporan->id_laporan,
                'foto' => $file
            ]);
        }

        return redirect('/data_semua_laporan')->with('success', 'Tambah Laporan Berhasil');
    }

    public function edit_laporan(Request $request)
    {
        $data = request()->except(['_token']);
        Laporan::where('id_laporan', $request->id_laporan)->update($data);
        return redirect()->back()->with('edit_success', 'Edit Laporan Berhasil');
    }

    public function delete_laporan(Request $request)
    {
        $delete = Laporan::where('id_laporan', $request->id_laporan);
        $delete->delete($delete);
        return redirect()->back()->with('hapus_success', 'Hapus Laporan Berhasil');
    }

    public function approval($id)
    {
        if(auth()->user()->level_user == 'Kepala Regu'){
        Laporan::where('id_laporan',$id)->update([
            'appv1' => auth()->user()->id_user,
            'tingkat' => 2,
        ]);
        }
        elseif(auth()->user()->level_user == 'Kepala Seksi'){
        Laporan::where('id_laporan',$id)->update([
            'appv2' => auth()->user()->id_user,
            'tingkat' => 3,
        ]);
        }
        elseif(auth()->user()->level_user == 'Kepala Bagian'){
        Laporan::where('id_laporan',$id)->update([
            'appv3' => auth()->user()->id_user,
            'tingkat' => 4,
            'publish' => 1,
        ]);
        }
        else{
            Laporan::where('id_laporan',$id)->update([
            'appv1' => auth()->user()->id_user,
            'appv2' => auth()->user()->id_user,
            'appv3' => auth()->user()->id_user,
            'tingkat' => 4,
            'publish' => 1,
        ]);
        }

        return redirect()->back()->with('approve_success', 'Approve Laporan Berhasil');

    }
}
