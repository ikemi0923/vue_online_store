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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // 主キー
            $table->string('customer_name'); // 注文者名
            $table->string('customer_phone'); // 電話番号
            $table->string('customer_email'); // メールアドレス
            $table->string('address'); // 住所
            $table->enum('status', ['未発送', '発送準備中', '発送済み'])->default('未発送'); // 発送ステータス
            $table->timestamps(); // 作成日・更新日
        });
    }
    
     /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
    
};
