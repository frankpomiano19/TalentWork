<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Seeders para occupation
        DB::table('questions')->insert([
            'pregunta' => "¿Cuanto tiempo demora el servicio?",
            'respuesta' => "Demora entre dos o tres días",
            // 'typeJobFromQuestion'=>'1',
            'use_occ_id' => '2',
        ]);

        DB::table('questions')->insert([
            'pregunta' => "¿Existe la posibilidad de obtener alguna rebaja?",
            'respuesta' => "Todo se puede conversar, asi que no se descarta",
            // 'typeJobFromQuestion'=>'1',
            'use_occ_id' => '2',
        ]);

        DB::table('questions')->insert([
            'pregunta' => "¿Que pasa si no arreglan mi problema?",
            'respuesta' => "No se le cobraría al cliente",
            // 'typeJobFromQuestion'=>'1',
            'use_occ_id' => '2',
        ]);

        DB::table('questions')->insert([
            'pregunta' => "¿Atienden todos los días?",
            'respuesta' => "Atendemos de Lunes a Domingo excepto los feriados",
            // 'typeJobFromQuestion'=>'1',
            'use_occ_id' => '2',
        ]);

        DB::table('questions')->insert([
            'pregunta' => "¿Hacen turnos nocturnos?",
            'respuesta' => "No, por un tema de seguridad trabajamos de 8:00 am hasta las 6:00 pm",
            // 'typeJobFromQuestion'=>'1',
            'use_occ_id' => '2',
        ]);


        //Seeders para talent
        DB::table('questions')->insert([
            'pregunta' => "¿Cuanto tiempo demora el servicio?",
            'respuesta' => "Demora entre dos o tres días",
            // 'typeJobFromQuestion'=>'2',
            'use_tal_id' => '1',
        ]);

        DB::table('questions')->insert([
            'pregunta' => "¿Existe la posibilidad de obtener alguna rebaja?",
            'respuesta' => "Todo se puede conversar, asi que no se descarta",
            // 'typeJobFromQuestion'=>'2',
            'use_tal_id' => '1',
        ]);

        DB::table('questions')->insert([
            'pregunta' => "¿Que pasa si no arreglan mi problema?",
            'respuesta' => "No se le cobraría al cliente",
            // 'typeJobFromQuestion'=>'2',
            'use_tal_id' => '1',
        ]);

        DB::table('questions')->insert([
            'pregunta' => "¿Atienden todos los días?",
            'respuesta' => "Atendemos de Lunes a Domingo excepto los feriados",
            // 'typeJobFromQuestion'=>'2',
            'use_tal_id' => '1',
        ]);

        DB::table('questions')->insert([
            'pregunta' => "¿Hacen turnos nocturnos?",
            'respuesta' => "No, por un tema de seguridad trabajamos de 8:00 am hasta las 6:00 pm",
            // 'typeJobFromQuestion'=>'2',
            'use_tal_id' => '1',
        ]);
    }
}
