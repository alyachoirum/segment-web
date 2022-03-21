<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regu extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_regu';

    protected $table = "regus";

    protected $fillable =
    [
        'id_regu',
        'nama_regu'
    ];

    public function karyawan() {
            return $this->hasMany(Karyawan::class, 'id_regu', 'id_regu');
    }

    protected $guarded = [];
}
