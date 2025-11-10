<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            if (!Schema::hasColumn('tickets', 'is_checked_in')) {
                $table->boolean('is_checked_in')->default(false);
            }

            if (!Schema::hasColumn('tickets', 'checked_in_at')) {
                $table->timestamp('checked_in_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            if (Schema::hasColumn('tickets', 'is_checked_in')) {
                $table->dropColumn('is_checked_in');
            }

            if (Schema::hasColumn('tickets', 'checked_in_at')) {
                $table->dropColumn('checked_in_at');
            }
        });
    }
};
