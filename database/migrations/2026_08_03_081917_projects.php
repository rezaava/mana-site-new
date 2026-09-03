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
                Schema::create('projects', function (Blueprint $table) {
                    $table->id();
                    $table->string('title', 100);
                    $table->text('brief', 500);
                    $table->text('desc')->nullable();
                    $table->tinyInteger('cat_id')->nullable();
                    $table->string('image_url')->nullable();
                    $table->text('challenge')->nullable();
                    $table->text('solution')->nullable();
                    $table->integer('number')->comment('This column is used to determine the order of the projects');
                    $table->string('subtitle')->nullable(); // افزونه‌ای برای حرفه‌ای شدن...
                    $table->string('client_name')->nullable(); // شرکت بهین فرتاک
                    $table->string('launch_year')->nullable(); // سال ۱۴۰۲
                    $table->string('duration')->nullable(); // ۳ سال
                    $table->string('project_link')->nullable(); // app.atra-trade.ir
                    $table->text('project_goal')->nullable(); // هدف پروژه
                    $table->text('testimonial')->nullable(); // نقل قول از کارفرما
                    $table->string('client_role')->nullable(); // سمت کارفرما
                    $table->timestamps();
                });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("projects");
    }
};
