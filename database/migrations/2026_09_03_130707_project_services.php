<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('name'); // نام خدمت مانند "طراحی UX/UI"
            $table->string('icon')->nullable(); // آیکون (اختیاری)
            $table->integer('order')->default(0); // ترتیب نمایش
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_services');
    }
};