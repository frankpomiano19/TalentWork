<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Post_comments')->insert([
            'comentario' => 'Comenten sus opiniones sobre mis diseños, en especial los momos',
            // 'typeJobFromComment'=>'1',
            'use_id' => '2',
            'use_occ_id' => '2',
        ]);
        DB::table('Post_comments')->insert([
            'comentario' => 'Recomiendo su servicio, +10/10',
            // 'typeJobFromComment'=>'1',
            'use_id' => '4',
            'use_occ_id' => '2',
        ]);
        DB::table('Post_comments')->insert([
            'comentario' => 'Dejen sus opiniones sobre mis cuentos, no olviden dejar sus ideas para incluirlas en mis proximas historias',
            // 'typeJobFromComment'=>'2',
            'use_id' => '2',
            'use_tal_id' => '1',
        ]);
        DB::table('Post_comments')->insert([
            'comentario' => 'Buenas historias, sobre todo la del pajaro y el arbol, 100% recomendado',
            // 'typeJobFromComment'=>'2',
            'use_id' => '7',
            'use_tal_id' => '1',
        ]);
    }
}
