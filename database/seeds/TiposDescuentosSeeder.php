<?php

use Illuminate\Database\Seeder;

class TiposDescuentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_descuento')->insert([
            'id' => 1,
            'nombre' => 'Producto',
        ]);

        DB::table('tipo_descuento')->insert([
            'id' => 2,
            'nombre' => 'Mayoreo'
        ]);

        DB::table('tipo_aplicacion_descuento')->insert([
            'id' => 1,
            'nombre' => 'Precio'
        ]);

        DB::table('tipo_aplicacion_descuento')->insert([
            'id' => 2,
            'nombre' => 'Porcentaje'
        ]);
    }
}
