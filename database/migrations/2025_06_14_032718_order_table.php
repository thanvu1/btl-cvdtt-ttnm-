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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('pending'); // pending, shipping, done, canceled
            $table->string('shipping_address');
            $table->foreignId('discount_code_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
        
}

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
