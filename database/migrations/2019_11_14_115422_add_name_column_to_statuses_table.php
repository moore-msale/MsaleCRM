<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNameColumnToStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('statuses', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('type')->after('name');
            $table->string('color')->after('type');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('statuses', function (Blueprint $table) {
            $table->dropColumn(['name','type','color']);
        });
    }
}
