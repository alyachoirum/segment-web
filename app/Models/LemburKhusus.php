<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class LemburKhusus extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_lembur_khusus';

    protected $table = "lembur_khususes";

    protected $fillable =
    [
        'id_lembur_khusus',
        'nik',
        'tgl_lembur_khusus',
        'detail',
        'total_jam_lembur_khusus',
        'validasi',
        'mengetahui',
        'approve',
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

    public function getTglLemburKhususAttribute(){
        return Carbon::parse($this->attributes['tgl_lembur_khusus'])
            ->translatedFormat('d F Y');
    }
    
    public function reject(){
        return $this->hasMany(Karyawan::class, 'nik', 'reject_by');
    }
}
