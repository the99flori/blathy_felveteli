<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('results', function (Blueprint $table) {
            $table->string('tt0023')->nullable()->change();
            $table->string('tt0025')->nullable()->change();
            $table->string('sumpoint')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('results', function (Blueprint $table) {
            $table->string('tt0023')->nullable(false)->change();
            $table->string('tt0025')->nullable(false)->change();
            $table->string('sumpoint')->nullable(false)->change();
        });
    }
}
