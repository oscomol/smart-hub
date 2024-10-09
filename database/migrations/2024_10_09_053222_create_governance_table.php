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
        Schema::create('governance', function (Blueprint $table) {
            $table->id();
            $table->string('chairman');
            $table->string('d_chairman');
            $table->string('a_chairman');
            $table->string('hod_science');
            $table->string('hod_mathematics');
            $table->string('hod_english');
            $table->string('hod_filipino');
            $table->string('hod_araling_panlipunan');
            $table->string('hod_values_education');
            $table->string('hod_mapeh');
            $table->string('hod_tle');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('governance');
    }
};
