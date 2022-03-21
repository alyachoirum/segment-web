<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function data_berita(){

        $dt_berita = DB::table('beritas')
            ->join('karyawans','karyawans.nik', '=', 'beritas.nik')
            ->select('karyawans.nama_lengkap','beritas.id_berita','beritas.judul','beritas.deskripsi','beritas.gambar',)
            ->get();

        return view('berita/berita',
            [
                'data_berita' => $dt_berita
            ]);
    }
    public function tambah_berita(Request $request)
    {
        $gambar_berita = $request->file('gambar');
        $gambar = rand() . '.' . $gambar_berita->getClientOriginalExtension();
        $gambar_berita->move(public_path('assets/gambar_berita'), $gambar);

        $berita = new Berita();
        $berita->judul = $request->judul;
        $berita->deskripsi = $request->deskripsi;
        $berita->nik = auth()->user()->nik;
        $berita->gambar = $gambar;
        $berita->save();
        return redirect()->back()->with('success', 'Tambah Berita Berhasil');
    }

    public function edit_berita(Request $request)
    {

        $gambar_berita = $request->file('gambar');
        $gambar = rand() . '.' . $gambar_berita->getClientOriginalExtension();
        $gambar_berita->move(public_path('assets/gambar_berita'), $gambar);

        Berita::where('id_berita', $request->id_berita)->update([
            'gambar' => $gambar,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->back()->with('edit_success', 'Edit Berita Berhasil');

        // $data = request()->except(['_token']);
        // Berita::where('id_berita', $request->id_berita)->update($data);
        // return redirect()->back()->with('edit_success', 'Edit Berita Berhasil');
    }

    public function delete_berita(Request $request)
    {
        $delete = Berita::where('id_berita', $request->id_berita);
        $delete->delete($delete);
        return redirect()->back()->with('hapus_success', 'Hapus Berita Berhasil');
    }
}
