<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';
    protected $fillable = ['dosen_id', 'matkul_id', 'materi'];

    public $timestamps = false;
}
