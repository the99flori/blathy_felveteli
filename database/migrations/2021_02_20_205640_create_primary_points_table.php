<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrimaryPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('primary_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id');
            $table->tinyInteger('lit_7')->nullable();
            $table->tinyInteger('lit_8h')->nullable();
            $table->tinyInteger('hun_7')->nullable();
            $table->tinyInteger('hun_8h')->nullable();
            $table->tinyInteger('math_7')->nullable();
            $table->tinyInteger('math_8h')->nullable();
            $table->tinyInteger('his_7')->nullable();
            $table->tinyInteger('his_8h')->nullable();
            $table->tinyInteger('flang_7')->nullable();
            $table->tinyInteger('flang_8h')->nullable();
            $table->tinyInteger('phy_7')->nullable();
            $table->tinyInteger('phy_8h')->nullable();

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
        Schema::dropIfExists('primary_points');
    }
}
