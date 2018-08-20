<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->string('city',255)->nullable();
            $table->string('state',255)->nullable();
            $table->string('country',255)->nullable();
            $table->string('phone',20)->nullable();
            $table->string('social_network',255)->nullable();
        });

        Schema::table('projects', function($table) {
            $table->text('info')->nullable();
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
