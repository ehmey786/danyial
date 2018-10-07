<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ShareholderLeasedate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('share_holders', function ($table) {
            $table->date('lease_date')->nullable();
            $table->date('visa_expiry')->nullable();
            $table->date('passport_expiry')->nullable();
            $table->date('lisc_expiry')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('share_holders',function($table){
            $table->dropColumn('lease_date');
            $table->dropColumn('visa_expiry');
            $table->dropColumn('passport_expiry');
            $table->dropColumn('lisc_expiry');
        });
    }
}