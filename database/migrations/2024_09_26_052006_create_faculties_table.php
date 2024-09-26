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
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('birth');
            $table->string('gender');
            $table->string('address');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('faculty_id')->unique();
            $table->string('degree');
            $table->string('specialization');
            $table->string('university');
            $table->year('graduation_year');
            $table->string('certification')->nullable();
            $table->string('language')->nullable();
            $table->date('employment_date');
            $table->string('current_position');
            $table->string('department');
            $table->string('employment_type');
            $table->text('experience')->nullable();
            $table->text('development_activities')->nullable();
            $table->text('workshops')->nullable();
            $table->text('conferences')->nullable();
            $table->text('research')->nullable();
            $table->text('awards')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculties');
    }
};
