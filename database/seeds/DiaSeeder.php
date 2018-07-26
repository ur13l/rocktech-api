<?php

use Illuminate\Database\Seeder;

class DiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dia')->insert([
            'id' => 1,
            'nombre' => 'Lunes',
            'index' => 0
        ]);
        DB::table('dia')->insert([
            'id' => 2,
            'nombre' => 'Martes',
            'index' => 1
        ]);
        DB::table('dia')->insert([
            'id' => 3,
            'nombre' => 'Miércoles',
            'index' => 2
        ]);
        DB::table('dia')->insert([
            'id' => 4,
            'nombre' => 'Jueves',
            'index' => 3
        ]);
        DB::table('dia')->insert([
            'id' => 5,
            'nombre' => 'Viernes',
            'index' => 4
        ]);
        DB::table('dia')->insert([
            'id' => 6,
            'nombre' => 'Sábado',
            'index' => 5
        ]);
        DB::table('dia')->insert([
            'id' => 7,
            'nombre' => 'Domingo',
            'index' => 6
        ]);
    }
}
