<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCentralExams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('central_exams', function (Blueprint $table) {
            $table->renameColumn('hun', 'hunResult');
            $table->renameColumn('math', 'mathResult');
            $table->integer('hunRoom')->nullable()->after('isHun');
            $table->integer('mathRoom')->nullable()->after('isMath');
            $table->boolean('isSpecial')->default(false)->after('math');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('central_exams', function (Blueprint $table) {
            $table->renameColumn('hunResult', 'hun');
            $table->renameColumn('mathResult', 'math');
            $table->removeColumn('hunRoom');
            $table->removeColumn('mathRoom');
            $table->removeColumn('isSpecial');
        });
    }
}
