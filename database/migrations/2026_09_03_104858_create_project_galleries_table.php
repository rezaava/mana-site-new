<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * ایجاد جدول گالری پروژه‌ها
     */
    public function up(): void
    {
        Schema::create('project_galleries', function (Blueprint $table) {
            $table->id();

            // پروژه‌ای که تصویر متعلق به آن است
            $table->foreignId('project_id')
                ->constrained('projects')
                ->onDelete('cascade');

            // دسته‌بندی تصویر
            // این مقدار از جدول cat_imgs می‌آید
            $table->foreignId('cat_img_id')
                ->constrained('cat_imgs')
                ->onDelete('cascade');

            // مسیر تصویر
            $table->string('image_url');

            $table->timestamps();
        });
    }

    /**
     * حذف جدول گالری پروژه‌ها
     */
    public function down(): void
    {
        Schema::dropIfExists('project_galleries');
    }
};