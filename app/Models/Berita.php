<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_berita';


    protected $table = "beritas";

    protected $fillable =
    [
        'id_berita',
        'judul',
        'deskripsi',
        'nik',
        'gambar'
    ];


    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'nik', 'nik');
    }
}
