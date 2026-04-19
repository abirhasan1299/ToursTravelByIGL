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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('payment_id')->unique(); // bKash paymentID
            $table->string('invoice_number')->nullable();

            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('BDT');

            $table->string('status')->default('Pending');
            // Pending | Completed | Failed

            $table->string('trx_id')->nullable(); // from execute response

            $table->json('raw_response')->nullable(); // full API response (optional)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
