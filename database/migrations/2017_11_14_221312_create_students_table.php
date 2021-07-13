<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->int('person_profile_id');
            $table->int('user_id');
            $table->int('process_type');
            $table->int('modality_id');
            $table->string('id_document');
            $table->string('university_identification');
            $table->string('university_email');
            $table->string('personal_email');
            $table->int('gender_id');
            $table->boolean('registered');
            $table->int('tutor_id');
            $table->int('reader_id');
            $table->decimal('grade');
            $table->int('presentation_status_id');
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
        Schema::dropIfExists('students');
    }
}
