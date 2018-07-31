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
            'nombre' => 'Admin',
        ]);
        DB::table('rol')->insert([
            'id' => 2,
            'nombre' => 'User',
        ]);
    }
}
