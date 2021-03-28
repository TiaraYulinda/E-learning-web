<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //jika menggunakan Student::create()
    protected $fillable = ['npm', 'nama', 'email', 'jurusan'];
}
