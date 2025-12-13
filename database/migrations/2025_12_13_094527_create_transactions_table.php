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
        $table->foreignId('user_id')->constrained(); // Siapa yang beli (untuk materi ini user statik ID 1)
        $table->foreignId('shoe_id')->constrained(); // Sepatu apa
        $table->integer('quantity');
        $table->decimal('total_price', 15, 2); // Total harga (harga sepatu x qty)
        $table->enum('status', ['pending', 'paid', 'sent'])->default('paid'); // Status transaksi
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
