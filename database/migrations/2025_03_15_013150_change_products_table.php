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
            // chỉnh sửa kiểu dữ liệu
            $table->bigInteger('category_id')->change();
            $table->unsignedInteger('price')->change();
            $table->unsignedInteger('quantity')->change();
            // thêm cột
            $table->text('description')->after('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // trả kiểu dữ liệu về ban đầu
            $table->integer('category_id')->change();
            $table->integer('price')->change();
            $table->integer('quantity')->change();
            // xóa cột
            $table->dropColumn('description');
        });
    }
};
