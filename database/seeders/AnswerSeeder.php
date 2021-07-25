<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert([
            'comentario' => 'Estan chidos tus momos, eres un crack',
            'use_id' => '7',
            'use_com_id' => '1',
        ]);
        DB::table('answers')->insert([
            'comentario' => 'Igual yo hermano, los mejores momos',
            'use_id' => '4',
            'use_com_id' => '2',
        ]);
        DB::table('answers')->insert([
            'comentario' => 'Tus historias son geniales, vale la pena cada centavo',
            'use_id' => '4',
            'use_com_id' => '3',
        ]);
        DB::table('answers')->insert([
            'comentario' => 'Muy linda historia y maravilloso final, me encanto a mi tambien',
            'use_id' => '7',
            'use_com_id' => '4',
        ]);
    }
}
