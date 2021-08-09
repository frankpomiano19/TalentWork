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

        $comentarios = array(0 => 'Comenten sus opiniones sobre mis diseños, en especial los momos',
         1 => 'Recomiendo su servicio, +10/10',
         2 => 'Dejen sus opiniones sobre mis cuentos, no olviden dejar sus ideas para incluirlas en mis proximas historias',
         3 => 'Buenas historias, sobre todo la del pajaro y el arbol, 100% recomendado');

        $idUsuarios = array(0 => '2', 1 => '4', 2 => '2', 3 => '7');

        $idSO = array(0 => '2', 1 => '2', 2 => null, 3 => null);

        $idST = array(0 => null, 1 => null, 2 => '1', 3 => '1');

        for ($i=0; $i <4 ; $i++) { 
            DB::table('Post_comments')->insert([
                'comentario' => $comentarios[$i],
                'use_id' => $idUsuarios[$i],
                'use_occ_id' => $idSO[$i],
                'use_tal_id' => $idST[$i]
            ]);
        }

    }
}
