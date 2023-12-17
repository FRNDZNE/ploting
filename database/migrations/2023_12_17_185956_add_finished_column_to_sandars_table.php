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
        Schema::table('sandars', function (Blueprint $table) {
            if (!Schema::hasColumn('sandars', 'finished')) {
                $table->boolean('finished')->default(0)->after('finish');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sandars', function (Blueprint $table) {
            if (Schema::hasColumn('sandars', 'finished')) {
                $table->dropColumn('finished');
            }
        });
    }
};
