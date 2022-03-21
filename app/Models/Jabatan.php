<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jabatan';

    protected $table = "jabatans";

    protected $fillable =
    [
        'id_jabatan',
        'nama_jabatan',
        'id_zona',
        'id_regu',
        'direct_jab_atasan',
        'direct_jab_atasan_2'
    ];


    public function karyawan() {
            return $this->hasMany(Karyawan::class, 'id_jabatan', 'id_jabatan');
    }

    public function regu(){
        return $this->belongsTo(Regu::class, 'id_regu', 'id_regu');
    }

    public function zona(){
        return $this->belongsTo(Zona::class, 'id_zona', 'id_zona');
    }

    public function atasan_1(){
        return $this->belongsTo(Karyawan::class, 'direct_jab_atasan', 'id_jabatan');
    }

    public function atasan_2(){
        return $this->belongsTo(Karyawan::class, 'direct_jab_atasan_2', 'id_jabatan');
    }

    protected $guarded = [];
}
