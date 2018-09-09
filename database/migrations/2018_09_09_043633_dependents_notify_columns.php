<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DependentsNotifyColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dpendents', function ($table) {
            $table->boolean('passport_expiry_notify')->default(false);
            $table->boolean('visa_expiry_notify')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dpendents',function($table){
            $table->dropColumn('passport_expiry_notify','1000')->nullable();
            $table->dropColumn('visa_expiry_notify','1000')->nullable();
        });
    }
}
