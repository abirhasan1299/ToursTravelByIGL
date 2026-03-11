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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('hero_header')->nullable();
            $table->string('hero_detail')->nullable();
            $table->string('company_title')->nullable();
            $table->string('mv')->nullable();
            $table->integer('exp_years')->nullable();
            $table->string('author_name')->nullable();
            $table->string('author_designation')->nullable();
            $table->string('author_img')->nullable();
            $table->integer('tour_success')->nullable();
            $table->integer('happy_traveler')->nullable();
            $table->integer('award')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
