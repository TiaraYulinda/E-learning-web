<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'role', 'username',
    ];

    protected $rules = [
        'npm' => 'sometimes|required|unique:users',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function mahasiswa()
    {
        return $this->hasOne('App\Mahasiswa');
    }

    public function dosen()
    {
        return $this->hasOne('App\Dosen');
    }

    public function tugasmahasiswa()
    {
        return $this->hasMany('App\TugasMahasiswa');
    }
    public function tugas()
    {
        return $this->hasMany('App\Tugas');
    }
}
