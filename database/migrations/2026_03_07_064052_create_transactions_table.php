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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('t_user_id');
            $table->foreign('t_user_id')->references('id')->on('users');
            $table->string('t_transaction_id');
            $table->integer('t_amount')->default(0);
            $table->string('t_currency')->default('BDT');
            $table->string('t_status')->default('pending');
            $table->string('t_reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
