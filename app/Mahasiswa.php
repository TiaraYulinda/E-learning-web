<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    //kalau table gk jamak 's
    protected $table = 'mahasiswa';
    protected $fillable = ['npm', 'nama', 'email', 'tempat_lahir', 'tgl_lahir', 'jurusan', 'foto', 'user_id', 'kelas_id', 'alamat', 'agama', 'gender', 'no_telpon', 'semester'];

    public $timestamps = false;

    public function getFotoProfile()
    {
        if (!$this->foto) {
            return asset('images/default.png');
        }
        return asset('images/' . $this->foto);
    }


    public function kelas()
    {
        return $this->belongsTo('App\Kelas');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // public function tugasmahasiswa()
    // {
    //     return $this->hasMany('App\TugasMahasiswa');
    // }
}
