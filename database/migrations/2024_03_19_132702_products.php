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
            $table->string('product_name', 100)->unique();
            $table->longText('description');
            $table->string('excerpt', 100);
            $table->string('img_filepath', 500);
            $table->double('price', 8, 2); 
            $table->integer('stock'); 
            $table->enum('size', ['S', 'M', 'L', 'XL', 'XXL']);
            $table->enum('variant', ['female', 'male', 'unisex']);
            $table->string('category', 20);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
