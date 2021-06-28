<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTalentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('use_tals')->insert([
            'use_id' => '2',
            'ser_tal_id' => '3',
            'descripcion' => 'Soy un buen narrador, cuento buenos chistes',
            'precio' => 100.00,
        ]);
        DB::table('use_tals')->insert([
            'use_id' => '3',
            'ser_tal_id' => '1',
            'descripcion' => 'Grabo videos abriendo cajas',
            'precio' => 10.00,
        ]);
    }
}
