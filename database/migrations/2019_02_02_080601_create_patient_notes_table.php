<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientNotesTable extends \App\BaseClasses\BaseMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('visit_id');
            $table->unsignedBigInteger('physician_id');
            $table->mediumText('chief_complaints')->nullable();
            $table->mediumText('hpi')->nullable();
            $table->mediumText('mdm')->nullable();
            //$table->string('exam')->nullable();
            $table->mediumText('treatment')->nullable();
            $table->mediumText('prescribed_medicine')->nullable();
            $table->mediumText('care_plan')->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('patient_notes');
    }
}
