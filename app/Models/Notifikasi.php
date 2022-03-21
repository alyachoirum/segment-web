<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_notifikasi';

    protected $table = "notifikasis";

    protected $fillable =
    [
        'id_notifikasi',
        'kategori_notifikasi',
        'judul_notifikasi',
        'isi_notifikasi',
        'user_id_penerima',
        'status'
    ];

    protected $guarded = [];
}
