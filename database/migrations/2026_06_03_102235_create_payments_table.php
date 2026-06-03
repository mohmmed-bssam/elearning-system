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
            $table->decimal('amount', 8, 2);
            $table->enum('status', ['pending', 'paid', 'failed']);
            $table->enum(
                'payment_gateway',
                ['paypal', 'stripe', 'cash']
            )->default('cash');
            $table->string('transaction_number')->nullable();
            $table->foreignId('user_id')->nullable()
                ->constrained()->nullOnDelete();
            $table->foreignId('course_id')->nullable()
                ->constrained()->nullOnDelete();

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
