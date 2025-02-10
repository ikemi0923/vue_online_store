<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id(); // 主キー
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // 注文ID（外部キー）
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // 商品ID（外部キー）
            $table->integer('quantity'); // 数量
            $table->integer('price'); // 商品価格
            $table->timestamps(); // 作成日・更新日
        });
    }
    
     /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
    
};
