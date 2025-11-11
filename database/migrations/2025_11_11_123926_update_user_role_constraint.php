<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Mevcut check constraint'i kaldır
        DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check;');

        // Yeni constraint ekle (artık admin de geçerli)
        DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role IN ('attendee', 'organizer', 'admin'));");
    }

    public function down(): void
    {
        // Eski haline döndür (admin kaldırılır)
        DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check;');
        DB::statement("ALTER TABLE users ADD CONSTRAINT users_role_check CHECK (role IN ('attendee', 'organizer'));");
    }
};
