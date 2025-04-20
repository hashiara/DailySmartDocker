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
        Schema::table('users', function (Blueprint $table) {
            // 既存カラムの削除
            $table->dropUnique(['email']);
            $table->dropColumn(['name', 'email', 'email_verified_at', 'remember_token']);

            // 既存の password カラムを nullable に変更
            $table->string('password', 255)->nullable()->change();

            // 新しいカラムの追加
            $table->string('user_id', 33)->unique()->after('id');
            $table->string('mail', 255)->nullable()->unique()->after('user_id');
            $table->string('user_name', 50)->nullable()->after('password');
            $table->date('birth')->nullable()->after('user_name');
            $table->string('otk', 12)->nullable()->unique()->after('birth');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // デフォルトでセットされていたマイグレーションのカラムに戻す
            $table->dropSoftDeletes();
            $table->dropColumn(['user_id', 'mail', 'user_name', 'birth', 'otk']);

            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('password')->nullable(false)->change();
        });
    }
};
