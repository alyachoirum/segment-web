<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PresensiLog extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_presensi';

    protected $table = "presensi_logs";

    protected $fillable =
    [
        'id_presensi',
        'nik',
        'tanggal' => 'date',
        'jadwal_kerja',
        'lat',
        'lng',
        'id_zona',
        'id_regu',
        'id_jabatan',
        'check_in',
        'check_out',
        'status',
        'detail',
        'id_lembur',
        'id_lembur_khusus',
        'id_absensi'
    ];

    protected $guarded = [];

    public function karyawans(){
        return $this->belongsTo('App\Models\Karyawan', 'nik', 'nik');
    }

    public function zonas(){
        return $this->belongsTo('App\Models\Zona', 'id_zona', 'id_zona');
    }

    public function getTanggalAttribute(){
        return Carbon::parse($this->attributes['tanggal'])
            ->translatedFormat('1, d F Y');
    }
}
