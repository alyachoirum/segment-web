<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function data_kategori(){
        $dt_kategori = DB::table('kategoris')->get();
        return view('master/informasi_kategori',
            [
                'data_kategori' => $dt_kategori
            ]);
    }
    public function tambah_kategori(Request $request)
    {
        $ikon_kategori = $request->file('gambar');
        $gambar = rand() . '.' . $ikon_kategori->getClientOriginalExtension();
        $ikon_kategori->move(public_path('assets/ikon_kategori'), $gambar);

        $kategori = new Kategori();
        $kategori->ikon_kategori = $gambar;
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->save();
        return redirect()->back()->with('success', 'Tambah Kategori Berhasil');
    }

    public function edit_kategori(Request $request)
    {

        // if($request->hasFile('gambar')){
        //     $ikon_kategori = $request->file('gambar');
        //     $gambar = rand() . '.' . $ikon_kategori->getClientOriginalExtension();
        //     $ikon_kategori->move(public_path('assets/ikon_kategori'), $gambar);
        // }
        // else{
        //     $gambar = $request->ikon_kategori;
        // }

        $ikon_kategori = $request->file('gambar');
        $gambar = rand() . '.' . $ikon_kategori->getClientOriginalExtension();
        $ikon_kategori->move(public_path('assets/ikon_kategori'), $gambar);

        Kategori::where('id_kategori', $request->id_kategori)->update([
            'ikon_kategori' => $gambar,
            'nama_kategori' => $request->nama_kategori
        ]);

        // User::where('id_user', $request->id_user)->update($data);
        return redirect()->back()->with('edit_success', 'Edit Kategori Berhasil');
        // $data = request()->except(['_token']);
        // Kategori::where('id_kategori', $request->id_kategori)->update($data);
        // return redirect()->back()->with('edit_success', 'Edit Kategori Berhasil');
    }

    public function delete_kategori(Request $request)
    {
        $delete = Kategori::where('id_kategori', $request->id_kategori);
        $delete->delete($delete);
        return redirect()->back()->with('hapus_success', 'Hapus Kategori Berhasil');
    }
}
