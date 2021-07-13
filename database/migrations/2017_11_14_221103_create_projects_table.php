<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->int('student_id');
            $table->int('project_type_id');
            $table->int('company_id');
            $table->string('general_problem');
            $table->string('general_objetive');
            $table->string('title');
            $table->string('current_status_of_case');
            $table->string('file');
            $table->int('status_id');
            $table->string('project_scopes');
            $table->string('specific_problems');
            $table->string('specific_objetives');
            $table->string('limitations');
            $table->string('tools');
            $table->int('process_type_id');
            $table->int('modality_id');
            $table->string('');
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
        Schema::dropIfExists('projects');
    }
}
