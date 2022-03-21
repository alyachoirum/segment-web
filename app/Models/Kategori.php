<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kategori';

    protected $table = "kategoris";

    protected $fillable =
    [
        'id_kategori',
        'ikon_kategori',
        'nama_kategori'
    ];

    protected $guarded = [];
}
