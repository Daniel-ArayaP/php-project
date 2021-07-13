<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectOpportunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_opportunities', function (Blueprint $table) {
            $table->increments('id');
            $table->int('company_id');
            $table->string('project_name');
            $table->string('project_description');
            $table->int('process_type_id');
            $table->string('owner_name');
            $table->string('owner_email');
            $table->string('owner_phone');
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
        Schema::dropIfExists('project_opportunities');
    }
}
