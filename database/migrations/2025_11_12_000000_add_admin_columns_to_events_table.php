<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            if (!Schema::hasColumn('events', 'organizer_id')) {
                $table->unsignedBigInteger('organizer_id')->nullable()->after('user_id');
                $table->foreign('organizer_id')->references('id')->on('users')->onDelete('set null');
            }

            if (!Schema::hasColumn('events', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable()->after('organizer_id');
                $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'organizer_id')) {
                $table->dropForeign(['organizer_id']);
                $table->dropColumn('organizer_id');
            }

            if (Schema::hasColumn('events', 'created_by')) {
                $table->dropForeign(['created_by']);
                $table->dropColumn('created_by');
            }
        });
    }
};
