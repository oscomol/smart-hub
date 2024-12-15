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
        Schema::create('entered_grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('grade');
            $table->unsignedInteger('grade_id');
            $table->unsignedInteger('section');
            $table->string('lrn');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entered_grades');
    }
};
