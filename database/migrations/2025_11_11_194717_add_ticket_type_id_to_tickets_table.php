<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            if (!Schema::hasColumn('tickets', 'ticket_type_id')) {
                $table->foreignId('ticket_type_id')
                    ->nullable()
                    ->constrained('ticket_types')
                    ->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            if (Schema::hasColumn('tickets', 'ticket_type_id')) {
                $table->dropConstrainedForeignId('ticket_type_id');
            }
        });
    }
};