<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOralPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oral_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->tinyinteger('etiq');
            $table->tinyinteger('intro');
            $table->tinyinteger('chat');
            $table->tinyinteger('task');
            $table->tinyinteger('it');

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
        Schema::dropIfExists('oral_points');
    }
}
