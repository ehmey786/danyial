<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDpendentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dpendents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->string('name');
            $table->string('relation');
            $table->string('passport_expiry');
            $table->string('visa_expiry_expiry');
            $table->string('document');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dpendents');
    }
}
