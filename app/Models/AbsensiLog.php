<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Models\Karyawan;


class AbsensiLog extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_absensi';

    protected $table = "absensi_logs";

    protected $fillable =
    [
        'id_absensi',
        'nik',
        'tgl_absen',
        'tipe_absen',
        'detail',
        'bukti',
        'validasi',
        'mengetahui',
        'terbit',
        'reject_by',
        'reject'
    ];

    protected $guarded = [];

    public function presensilog(){
        return $this->hasMany('App\Models\PresensiLog', 'nik', 'nik');
    }

    public function karyawan(){
        return $this->hasOne(Karyawan::class, 'nik', 'nik');
    }

    public function reject(){
        return $this->hasMany(Karyawan::class, 'nik', 'reject_by');
    }

    public function getTglAbsenAttribute(){
        return Carbon::parse($this->attributes['tgl_absen'])
            ->translatedFormat('d F Y');
            // ->translatedFormat('1, d F Y');
    }


}
