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
        Schema::create('admins', function (Blueprint $table) {
            $table->id(); // 主キー
            $table->string('email')->unique(); // メールアドレス（ユニーク）
            $table->string('password'); // パスワード
            $table->timestamps(); // 作成日・更新日
        });
    }
    
     /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
    
};
