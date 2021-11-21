<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentralExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('central_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->boolean('isHun')->default(false);
            $table->tinyInteger('hun')->default(0);
            $table->boolean('isMath')->default(false);
            $table->tinyInteger('math')->default(0);

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
        Schema::dropIfExists('central_exams');
    }
}
