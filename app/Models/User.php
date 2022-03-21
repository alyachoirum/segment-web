<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';

    protected $fillable = [
        'id_user',
        'nik',
        'email',
        'password',
        'id_level_user',
        'foto',
        'id_departemen',
        'token_web',
        'token_mobile',
        'email_verified_at'
    ];

    public function level_user(){
        return $this->belongsTo(LevelUser::class, 'id_level_user', 'id_level_user');
    }

    public function departemen(){
        return $this->belongsTo(Departemen::class, 'id_departemen', 'id_departemen');
    }

    public function karyawan(){
        return $this->belongsTo(Karyawan::class, 'nik', 'nik');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

}
