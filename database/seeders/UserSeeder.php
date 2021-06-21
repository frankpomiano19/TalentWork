<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_get();
        date_default_timezone_set('America/Lima');
        date('Y-m-d H:i:s');  
        $passwordNow = null;         
        $passwordNow = Hash::make('password');
        DB::table('users')->insert([
            'name' => Str::random(10),
            'lastname' => Str::random(10).'@gmail.com',
            'DNI' => Str::random(10).'@gmail.com',
            'email' => Str::random(10).'@gmail.com',
            'birthdate' => Carbon::now(),
            'password' => $passwordNow,
            'password_confirmation'=>$passwordNow
        ]);
        $passwordNow = Hash::make('password');
        DB::table('users')->insert([
            'name' => Str::random(10),
            'lastname' => Str::random(10).'@gmail.com',
            'DNI' => Str::random(10).'@gmail.com',
            'email' => Str::random(10).'@gmail.com',
            'birthdate' => Carbon::now(),
            'password' => $passwordNow,
            'password_confirmation'=>$passwordNow
        ]);

    }
}
