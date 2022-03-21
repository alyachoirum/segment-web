<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_karyawan';

    protected $table = "karyawans";

    protected $fillable =
    [
        'id_karyawan',
        'nik',
        'nama_lengkap',
        'id_zona',
        'id_regu',
        'id_jabatan',
        'sisa_cuti',
        'pt',
        'no_kib',
        'tgl_lahir',
        'alamat',
        'rtrw',
        'desa',
        'kecamatan',
        'kabupaten',
        'no_hp',
        'no_ktp',
        'kompetensi_gada',
        'no_reg',
        'no_kta',
        'no_ijazah',
        'tgl_jatuhtempo_gada',
        'status_aktif'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'nik', 'nik');
    }

    public function regu(){
        return $this->belongsTo(Regu::class, 'id_regu', 'id_regu');
    }

    public function zona(){
        return $this->belongsTo(Zona::class, 'id_zona', 'id_zona');
    }

    public function jabatan(){
        return $this->belongsTo(Jabatan::class, 'id_jabatan', 'id_jabatan');
    }

    public function validasi_spl(){
        return $this->belongsTo(Lembur::class, 'nik', 'validasi');
    }

    public function mengetahui_spl(){
        return $this->belongsTo(Lembur::class, 'nik', 'mengetahui');
    }

    public function validasi(){
        return $this->belongsTo(LemburKhusus::class, 'nik', 'validasi');
    }

    public function mengetahui(){
        return $this->belongsTo(LemburKhusus::class, 'nik', 'mengetahui');
    }

    public function apv_pihak2(){
        return $this->belongsTo(TukarShift::class, 'nik', 'apv_pihak2');
    }

    public function apv_kajaga_p1(){
        return $this->belongsTo(TukarShift::class, 'nik', 'apv_kajaga_p1');
    }

    public function apv_kajaga_p2(){
        return $this->belongsTo(TukarShift::class, 'nik', 'apv_kajaga_p2');
    }

    public function approve(){
        return $this->belongsTo(LemburKhusus::class, 'nik', 'approve');
    }

    public function presensilog(){
        return $this->hasMany(PresensiLog::class, 'nik', 'nik');
    }

    public function presensiHadir(){
        return $this->hasMany(PresensiLog::class, 'nik', 'nik')->count();
    }





    protected $guarded = [];
}
