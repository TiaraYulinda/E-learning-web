<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $fillable = ['nidn', 'nama', 'email', 'no_telpon', 'user_id', 'foto', 'gender', 'alamat', 'tgl_lahir', 'tempat_lahir', 'agama'];

    public $timestamps = false;

    public function getFotoProfile()
    {
        if (!$this->foto) {
            return asset('images/default.png');
        }
        return asset('images/' . $this->foto);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tugas()
    {
        return $this->hasMany('App\Tugas');
    }

    public function matkul()
    {
        return $this->belongsToMany('App\Matkul')->withPivot(['kelas_id', 'id']);
    }

    public function kelas()
    {
        return $this->hasMany('App\Kelas',  'kelas');
    }
}
