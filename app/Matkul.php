<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Matkul extends Model
{
    protected $table = 'matkul';
    protected $fillable = ['kode', 'nama', 'semester'];

    public $timestamps = false;

    public function tugas()
    {
        return $this->hasMany('App\Tugas');
    }

    public function dosen()
    {
        return $this->belongsToMany('App\Dosen')->withPivot(['kelas_id', 'id']);
    }

    public function semester()
    {
        return $this->belongsTo('App\Semester');
    }
}
