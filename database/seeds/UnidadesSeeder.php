<?php

use Illuminate\Database\Seeder;

class UnidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_unidad')->insert([
            'id' => 1,
            'nombre' => 'Peso',
        ]);

        DB::table('tipo_unidad')->insert([
            'id' => 2,
            'nombre' => 'Distancia',
        ]);

        DB::table('tipo_unidad')->insert([
            'id' => 3,
            'nombre' => 'Porcentaje',
        ]);

        DB::table('unidad')->insert([
            'id' => 1,
            'nombre' => 'Kilogramos',
            'id_tipo_unidad' => 1
        ]);

        DB::table('unidad')->insert([
            'id' => 2,
            'nombre' => 'Libras',
            'id_tipo_unidad' => 1
        ]);

        DB::table('unidad')->insert([
            'id' => 3,
            'nombre' => 'Metros',
            'id_tipo_unidad' => 2
        ]);

        DB::table('unidad')->insert([
            'id' => 4,
            'nombre' => 'Kilómetros',
            'id_tipo_unidad' => 2
        ]);

        DB::table('unidad')->insert([
            'id' => 5,
            'nombre' => 'Millas',
            'id_tipo_unidad' => 2
        ]);


    }
}
