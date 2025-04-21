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
        if (Schema::hasTable('mechanics')) {
            Schema::table('mechanics', function (Blueprint $table) {
                if (!Schema::hasColumn('mechanics', 'specialty')) {
                    $table->string('specialty')->nullable();
                }
                if (!Schema::hasColumn('mechanics', 'experience')) {
                    $table->integer('experience')->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('mechanics')) {
            Schema::table('mechanics', function (Blueprint $table) {
                $table->dropColumn(['specialty', 'experience']);
            });
        }
    }
};