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
        Schema::create('company_packages', function (Blueprint $table) {
            $table->id();
            $table->string('p_name');
            $table->longText('p_detail');
            $table->longText('p_benefit');
            $table->integer('p_price');
            $table->string('p_date_range');
            $table->integer('p_post_limit');
            $table->string('p_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_packages');
    }
};
