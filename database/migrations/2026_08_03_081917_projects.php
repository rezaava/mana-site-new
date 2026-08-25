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
                    $table->tinyInteger('cat-id')->nullable();
                    $table->string('image_url');
                    $table->integer('number')->comment('This column is used to determine the order of the projects');
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
