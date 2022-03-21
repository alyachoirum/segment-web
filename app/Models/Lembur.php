<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class Lembur extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_lembur';

    protected $table = "lemburs";

    protected $fillable =
    [
        'id_lembur',
        'nik',
        'tgl_lembur',
        'detail',
        'total_jam_lembur',
        'validasi',
        'mengetahui',
        'terbit',
        'reject_by',
        'reject'
    ];

    protected $guarded = [];

    public function presensilog(){
        return $this->hasMany('App\Models\PresensiLog', 'id_lembur', 'id_lembur');
    }

    public function karyawan(){
        return $this->hasOne(Karyawan::class, 'nik', 'nik');
    }

    public function getTglLemburAttribute(){
        return Carbon::parse($this->attributes['tgl_lembur'])
            ->translatedFormat('d F Y');
    }
    
    public function reject(){
        return $this->hasMany(Karyawan::class, 'nik', 'reject_by');
    }
}
