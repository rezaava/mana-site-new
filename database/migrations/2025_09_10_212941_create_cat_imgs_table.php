<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * ایجاد جدول دسته‌بندی تصاویر
     */
    public function up(): void
    {
        Schema::create('cat_imgs', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->integer('number')->default(0);
            $table->timestamps();
        });
    }

    /**
     * حذف جدول دسته‌بندی تصاویر
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_imgs');
    }
};