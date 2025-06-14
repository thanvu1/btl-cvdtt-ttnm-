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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stock');
            $table->string('image_path'); // lưu đường dẫn ảnh
            $table->boolean('is_main')->default(false); // đánh dấu ảnh chính nếu cần
            $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
