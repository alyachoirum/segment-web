<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanBukti extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_laporan_bukti';

    protected $table = "laporan_buktis";

    protected $fillable =
    [
        'id_laporan_bukti',
        'id_laporan',
        'foto'

    ];

    public function laporan(){
        return $this->belongsTo(Laporan::class, 'id_laporan', 'id_laporan');
    }

    protected $guarded = [];
}
