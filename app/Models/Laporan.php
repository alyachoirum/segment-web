<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_laporan';

    protected $table = "laporans";

    protected $fillable =
    [
        'id_laporan',
        'nik',
        'judul_laporan',
        'id_kategori',
        'prioritas',
        'deskripsi',
        'tingkat',
        'appv1',
        'appv2',
        'appv3',
        'publish',
        'lat',
        'lng'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'nik', 'nik');
    }

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

     public function laporan_bukti(){
        return $this->belongsTo(LaporanBukti::class, 'id_laporan', 'id_laporan');
    }

    protected $guarded = [];
}
