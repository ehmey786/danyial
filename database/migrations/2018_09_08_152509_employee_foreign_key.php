<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmployeeForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dpendents', function ($table) {
          //  $table->dropForeign(['event_id']);
            if (!Schema::hasColumn('dpendents', 'employee_id')){
                $table->integer('employee_id')->unsigned();
            }

            $table->foreign(['employee_id'])->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dpendents', function ($table) {
              $table->dropForeign(['employee_id']);

        });
    }
}
