<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Departemen;

class DepartemenController extends Controller
{
    public function data_departemen(){
        $dt_departemen = DB::table('departemens')->get();
        return view('master/informasi_departemen',
            [
                'data_departemen' => $dt_departemen
            ]);
    }
    public function tambah_departemen(Request $request)
    {
        $departemen = new Departemen();
        $departemen->nama_departemen = $request->nama_departemen;
        $departemen->save();
        return redirect()->back()->with('success', 'Tambah Departemen Berhasil');
    }

    public function edit_departemen(Request $request)
    {
        $data = request()->except(['_token']);
        Departemen::where('id_departemen', $request->id_departemen)->update($data);
        return redirect()->back()->with('edit_success', 'Edit Departemen Berhasil');
    }

    public function delete_departemen(Request $request)
    {
        $delete = Departemen::where('id_departemen', $request->id_departemen);
        $delete->delete($delete);
        return redirect()->back()->with('hapus_success', 'Hapus Departemen Berhasil');
    }
}
