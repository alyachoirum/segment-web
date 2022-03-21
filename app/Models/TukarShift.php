<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Models\Karyawan;


class TukarShift extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_tukar_shift';

    protected $table = "tukar_shifts";

    protected $fillable =
    [
        'id_tukar_shift',
        'tgl_tukar',
        'nik_pihak1',
        'nik_pihak2',
        'nik_kajaga_pihak1',
        'nik_kajaga_pihak2',
        'awal_jam_kerja',
        'ubah_jam_kerja',
        'apv_pihak2',
        'apv_kajaga_p1',
        'apv_kajaga_p2',
        'terbit',
        'reject_by',
        'reject',
    ];

    protected $guarded = [];

    public function getTglTukarAttribute(){
        return Carbon::parse($this->attributes['tgl_tukar'])
            ->translatedFormat('d F Y');
    }

    public function karyawan(){
        return $this->hasOne(Karyawan::class, 'nik', 'nik_pihak1');
    }

    public function pihak_1(){
        return $this->hasOne(Karyawan::class, 'nik', 'nik_pihak1');
    }
    public function pihak_2(){
        return $this->hasOne(Karyawan::class, 'nik', 'nik_pihak2');
    }

    public function reject(){
        return $this->hasMany(Karyawan::class, 'nik', 'reject_by');
    }
    
}
