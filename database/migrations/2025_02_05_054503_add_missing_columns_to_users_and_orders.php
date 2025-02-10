<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->nullable()->after('zip');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->string('name')->nullable()->after('user_id');
            $table->string('furigana')->nullable()->after('name');
            $table->string('zip')->nullable()->after('furigana');
            $table->string('address')->nullable()->after('zip');
            $table->string('phone')->nullable()->after('address');
            $table->string('payment_method')->nullable()->after('phone');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['name', 'furigana', 'zip', 'address', 'phone', 'payment_method']);
        });
    }
};
