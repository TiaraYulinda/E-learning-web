<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tugas extends Model
{
    protected $table = 'tugas';
    protected $fillable = ['user_dsn_id', 'matkul_id', 'soal_tugas', 'kelas_id', 'semester', 'tanggal_deadline', 'status_tugas', 'judul_tugas', 'tipe'];
    public $timestamps = false;

    public function getFotoProfile()
    {
        if (!$this->foto) {
            return asset('images/default.png');
        }
        return asset('images/' . $this->foto);
    }

    use SoftDeletes;


    public function matkul()
    {
        return $this->belongsTo('App\Matkul');
    }

    public function dosen()
    {
        return $this->belongsTo('App\Dosen');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas');
    }

    public function semester()
    {
        return $this->belongsTo('App\Semester');
    }

    public function tugasmahasiswa()
    {
        return $this->hasMany('App\TugasMahasiswa', 'tugas_id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_dsn_id');
    }
}
