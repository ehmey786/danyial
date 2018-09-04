<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompanyColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies',function($table){
            $table->string('zone')->nullable();
            $table->string('issue_date')->nullable();
            $table->string('lic_no')->nullable();

            $table->string('email')->nullable();
            $table->string('main_activity')->nullable();

            $table->string('address','3000')->nullable();});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies',function ($table){
            $table->dropColumn('zone');
            $table->dropColumn('issue_date');
            $table->dropColumn('lic_no');
            $table->dropColumn('email');
            $table->dropColumn('main_activity');
            $table->dropColumn('address');
        });
    }
}
