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
        Schema::table('mechanics', function (Blueprint $table) {
            $table->string('specialty')->nullable()->after('name');
            $table->integer('experience')->nullable()->after('specialty');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mechanics', function (Blueprint $table) {
            $table->dropColumn(['specialty', 'experience']);
        });
    }
};