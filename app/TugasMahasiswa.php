<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TugasMahasiswa extends Model
{
    protected $table = 'jawaban';
    protected $fillable = ['tugas_id', 'user_mhs_id', 'jawaban', 'tipe', 'judul'];

    public $timestamps = false;

    use SoftDeletes;

    public function tugas()
    {
        return $this->belongsTo('App\Tugas', 'tugas_id')->withTrashed();
    }

    // public function mahasiswa()
    // {
    //     return $this->belongsTo('App\Mahasiswa');
    // }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_mhs_id');
    }
}
