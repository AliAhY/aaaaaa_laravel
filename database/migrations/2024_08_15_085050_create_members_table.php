<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('gender');
            $table->date('dob');
            $table->text('lob');
            $table->text('marital_status');
            $table->integer('family_member');
            $table->boolean('disability');
            $table->text('disability_type')->nullable();
            $table->boolean('disability_company');
            $table->boolean('family_disability');
            $table->text('family_disability_type')->nullable();
            $table->integer('count_of_worker');
            $table->string('father_job',length: 500);
            $table->string('mother_job',length: 500);
            $table->string('military_status');
            $table->string('city');
            $table->text('address');
            $table->text('location_status');
            $table->integer('phone1');
            $table->integer('phone2');
            $table->bigInteger('national_id');
            $table->string('education_certificate');
            $table->string('education_field')->nullable();
            $table->integer('date_of_certificate')->nullable();
            $table->boolean('graduated');
            $table->integer('university_year')->nullable();
            $table->boolean('icdl');
            $table->text('other_certificates')->nullable();
            $table->text('previous_courses')->nullable();
            $table->boolean('beneficial_undp');
            $table->boolean('current_volunteer');
            $table->string('organization_name')->nullable();
            $table->text('previous_experiences')->nullable();
            $table->boolean('work_now');
            $table->text('current_job')->nullable();
            $table->string('favorite_job');
            $table->integer('course_chosen_id');
            $table->integer('fragility_father_job');
            $table->integer('fragility_mother_job');
            $table->integer('fragility_disability');
            $table->integer('fragility_family_member');
            $table->integer('fragility_family_worker');
            $table->integer('fragility_military');
            $table->string('final_result');
            $table->longText('description');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
