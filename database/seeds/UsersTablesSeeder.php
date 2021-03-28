<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name'              => 'Tiara Yulinda',
            'email'             => 'tiara@gmail.com',
            'password'          => Hash::make('password'),
            'remember_token'   => Str::random(10)
        ]);
    }
}
