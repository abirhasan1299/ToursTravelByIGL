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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('title');
            $table->string('cover_img')->nullable();
            $table->integer('amount');
            $table->integer('day')->nullable();
            $table->integer('night')->nullable();
            $table->integer('max_people')->nullable();
            $table->string('tour_type')->nullable();
            $table->string('start_location');
            $table->string('end_location');
            $table->longText('include');
            $table->longText('exclude');
            $table->longText('detail');
            $table->string('status');
            $table->string('subdestination');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
