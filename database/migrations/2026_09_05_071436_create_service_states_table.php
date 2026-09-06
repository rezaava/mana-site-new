<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_states', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_id')
                ->constrained('services')
                ->cascadeOnDelete();

            $table->string('text_1');
            $table->string('value_1');

            $table->string('text_2');
            $table->string('value_2');

            $table->string('text_3');
            $table->string('value_3');

            $table->string('text_4');
            $table->string('value_4');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_states');
    }
};