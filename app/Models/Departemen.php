<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_departemen';


    protected $table = "departemens";

    protected $fillable =
    [
        'id_departemen',
        'nama_departemen'
    ];

    

    protected $guarded = [];
}
