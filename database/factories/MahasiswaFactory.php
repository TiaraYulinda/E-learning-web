<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Mahasiswa::class, function (Faker $faker) {
    return [
        'npm' => $faker->unixTime($max = 'now'),
        'nama' => $faker->name,
        'email' => $faker->email,
        'jurusan' => $faker->randomElement(['Sistem Informasi', 'Teknik Informatika']),
        'user_id' => 100,
        'kelas_id' => 100,
    ];
});
