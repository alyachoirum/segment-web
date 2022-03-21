<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_zona';

    protected $table = "zonas";

    protected $fillable =
    [
        'id_zona',
        'nama_zona',
        'lat',
        'lng',
        'radius_meter'
    ];

    public function karyawan() {
            return $this->hasMany(Karyawan::class, 'id_zona', 'id_zona');
    }

    public function presensilog(){
        return $this->hasMany('App\Models\Zona', 'id_zona', 'id_zona');
    }

    protected $guarded = [];
}
