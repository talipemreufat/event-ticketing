<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FixTicketIdSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('ALTER TABLE tickets ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY;');
    }
}
