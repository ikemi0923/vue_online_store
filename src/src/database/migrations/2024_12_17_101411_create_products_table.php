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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // 主キー
            $table->string('name'); // 商品名
            $table->text('description')->nullable(); // 商品説明
            $table->integer('price'); // 価格
            $table->integer('stock')->default(0); // 在庫数
            $table->string('image_path')->nullable(); // 画像パス
            $table->timestamps(); // 作成日・更新日
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
    
};
