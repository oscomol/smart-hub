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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('lrn')->unique();
            $table->string('name');
            $table->enum('sex', ['Male', 'Female']);
            $table->date('birth_date');
            $table->string('mother_tongue');
            $table->string('ip_ethnic_group');
            $table->string('religion');
            $table->string('barangay');
            $table->string('municipality');
            $table->unsignedBigInteger('guardian_id')->nullable(); // Foreign Key
            $table->string('contact_number');
            $table->string('learning_modality');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
