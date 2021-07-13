<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectDefensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_defenses', function (Blueprint $table) {
            $table->increments('id');
            $table->int('student_id');
            $table->time('defense_time');
            $table->timestamp('defense_date');
            $table->string('classroom');
            $table->int('academic_representative_id');
            $table->int('project_id');
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
        Schema::dropIfExists('project_defenses');
    }
}
