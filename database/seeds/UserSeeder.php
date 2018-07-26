<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Uriel Infante',
            'email' => 'ur13l.infante@gmail.com',
            'password' => bcrypt('123asdZXC'),
        ]);

        DB::table('users')->insert([
            'name' => 'Adalberto López',
            'email' => 'adalberto.lopez.torres@gmail.com',
            'password' => bcrypt('123asdZXC'),
        ]);
    }
}
