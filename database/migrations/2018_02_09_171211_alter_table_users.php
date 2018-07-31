<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('neurons', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('leader_id')->unsigned();
        });

        Schema::table('users', function($table) {
            $table->integer('neuron_id')->unsigned();
            $table->foreign('neuron_id')->references('id')->on('neurons');
        });

        Schema::table('neurons', function($table) {
            $table->foreign('leader_id')->references('id')->on('users');
        });

        Schema::create('projects', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('video', 2000);
            $table->text('objective');
            $table->integer('neuron_id')->unsigned();
            $table->foreign('neuron_id')->references('id')->on('neurons');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
