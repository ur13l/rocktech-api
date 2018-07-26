<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rol')->insert([
            'id' => 1,
            'nombre' => 'Master',
        ]);
        DB::table('rol')->insert([
            'id' => 2,
            'nombre' => 'Admin WA',
        ]);
        DB::table('rol')->insert([
            'id' => 3,
            'nombre' => 'Admin Cliente',
        ]);
        DB::table('rol')->insert([
            'id' => 4,
            'nombre' => 'Admin Sucursal',
        ]);
        DB::table('rol')->insert([
            'id' => 5,
            'nombre' => 'Entrenador',
        ]);
        DB::table('rol')->insert([
            'id' => 6,
            'nombre' => 'Atleta',
        ]);
        DB::table('rol')->insert([
            'id' => 7,
            'nombre' => 'Caja',
        ]);
    }
}
