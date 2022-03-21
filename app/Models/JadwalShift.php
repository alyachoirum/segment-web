<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalShift extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jadwal_shift';

    protected $table = "jadwal_shifts";

    protected $fillable =
    [
        'id_jadwal',
        'tanggal',
        'bulan',
        'tahun',
        'id_regu',
        'pattern_number',
        'jam_masuk',
        'jam_keluar',
        'action'
    ];

    protected $guarded = [];

    public function regu(){
        return $this->belongsTo(Regu::class, 'id_regu', 'id_regu');
    }
}
