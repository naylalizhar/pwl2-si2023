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
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'product_category_id')) {
                $table->unsignedBigInteger('product_category_id')->nullable()->index();
            }
            if (!Schema::hasColumn('products', 'id_supplier')) {
                $table->string('id_supplier');
            }
            if (!Schema::hasColumn('products', 'image')) {
                $table->string('image');
            }
            if (!Schema::hasColumn('products', 'title')) {
                $table->string('title');
            }
            if (!Schema::hasColumn('products', 'description')) {
                $table->text('description');
            }
            if (!Schema::hasColumn('products', 'price')) {
                $table->bigInteger('price');
            }
            if (!Schema::hasColumn('products', 'stock')) {
                $table->integer('stock')->default(0);
            }
            // Jangan tambahkan timestamps jika sudah ada
            if (!Schema::hasColumns('products', ['created_at', 'updated_at'])) {
                $table->timestamps();
            }
        });
        
        

        Schema::create('category_product', function (Blueprint $table) {
            $table->id();
            $table->string('product_category_name');
            $table->timestamps();
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
