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
            'name' => "Pato",
            'lastname' => "Parodi",
            'DNI' => '65474357',
            'email' => Str::random(10).'@gmail.com',
            'birthdate' => Carbon::now(),
            'password' => $passwordNow,
            'password_confirmation'=>$passwordNow
        ]);
        $passwordNow = Hash::make('vacassss');
        DB::table('users')->insert([
            'name' => "Vizcarra Presidente",
            'lastname' => "2026",
            'DNI' => '23753421',
            'email' => Str::random(10).'@gmail.com',
            'birthdate' => Carbon::now(),
            'password' => $passwordNow,
            'password_confirmation'=>$passwordNow
        ]);
        $passwordNow = Hash::make('valorant');
        DB::table('users')->insert([
            'name' => "Merino",
            'lastname' => "Lamas",
            'DNI' => '12345213',
            'email' => Str::random(10).'@gmail.com',
            'birthdate' => Carbon::now(),
            'password' => $passwordNow,
            'password_confirmation'=>$passwordNow
        ]);
        $passwordNow = Hash::make('cienciano');
        DB::table('users')->insert([
            'name' => "Presidente",
            'lastname' => "UNMSM",
            'DNI' => '65374567',
            'email' => Str::random(10).'@gmail.com',
            'birthdate' => Carbon::now(),
            'password' => $passwordNow,
            'password_confirmation'=>$passwordNow
        ]);     

        $passwordNow = Hash::make('mandarin');
        DB::table('users')->insert([
            'name' => "caminante no hay camino",
            'lastname' => "se hace camino al andar",
            'DNI' => '23463456',
            'email' => 'mandarin@gmail.com',
            'birthdate' => Carbon::now(),
            'password' => $passwordNow,
            'password_confirmation'=>$passwordNow
        ]);


    }
}
