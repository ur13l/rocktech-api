<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('name');
            $table->text('consumer_token')->nullable()->change();
            $table->integer('nivel')->nullable()->change();
            $table->integer('puntos_exp')->nullable()->change();
            $table->integer('id_titulo')->nullable()->unsigned()->change();
            $table->integer('puntos_dinero')->nullable()->change();
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
