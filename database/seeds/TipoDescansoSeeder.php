<?php

use Illuminate\Database\Seeder;

class TipoDescansoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_descanso')->insert([
            'id' => 1,
            'nombre' => 'Entre sets'
        ]);

        DB::table('tipo_descanso')->insert([
            'id' => 2,
            'nombre' => 'Entre ejercicios'
        ]);
    }
}
