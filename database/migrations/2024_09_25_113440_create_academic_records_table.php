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
        Schema::create('academic_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade'); // Foreign key to students table
            
            // Preschool Fields
            $table->string('preschool_name')->nullable();
            $table->year('preschool_year_graduated')->nullable();
            $table->text('preschool_awards')->nullable();
            
            // Elementary Fields
            $table->string('elementary_school_name')->nullable();
            $table->year('elementary_year_graduated')->nullable();
            $table->text('elementary_awards')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_records');
    }
};
