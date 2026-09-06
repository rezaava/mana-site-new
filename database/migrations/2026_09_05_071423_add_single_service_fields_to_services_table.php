<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->text('description')->nullable()->after('text');

            $table->string('delivery_time')->nullable()->after('description');
            $table->string('price_text')->nullable()->after('delivery_time');
            $table->string('support')->nullable()->after('price_text');

            $table->string('suitable_for')->nullable()->after('support');
            $table->string('contract')->nullable()->after('suitable_for');

            $table->longText('overview')->nullable()->after('contract');

            $table->string('challenge_title')->nullable()->after('contract');
            $table->text('challenge_text')->nullable()->after('challenge_title');

            $table->string('solution_title')->nullable()->after('challenge_text');
            $table->text('solution_text')->nullable()->after('solution_title');

            $table->text('quote_text')->nullable()->after('solution_text');
            $table->string('quote_person')->nullable()->after('quote_text');
            $table->string('quote_role')->nullable()->after('quote_person');

            $table->string('cta_title')->nullable()->after('quote_role');
            $table->text('cta_text')->nullable()->after('cta_title');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'delivery_time',
                'price_text',
                'support',
                'suitable_for',
                'overview',
                'contract',
                'challenge_title',
                'challenge_text',
                'solution_title',
                'solution_text',
                'quote_text',
                'quote_person',
                'quote_role',
                'cta_title',
                'cta_text',
            ]);
        });
    }
};