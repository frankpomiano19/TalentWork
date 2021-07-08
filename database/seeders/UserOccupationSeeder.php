<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserOccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('use_occs')->insert([
            'use_id' => '1',
            'ser_occ_id' => '2',
            'descripcion' => 'Reparo todo tipo de computadoras, laptos, lo que deseas te lo reparo',
            'precio' => 20.00,


        ]);
        DB::table('use_occs')->insert([
            'use_id' => '2',
            'ser_occ_id' => '1',
            'descripcion' => 'Hago cualquier tipo de diseño grafico 2D o 3D, tambien hagos buenos momos, echate un OjitO por aqui',
            'precio' => 20.00,
            
        ]);

    }
}
