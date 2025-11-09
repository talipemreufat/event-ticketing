<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;

class PreventRequestsDuringMaintenance extends Middleware
{
    /**
     * Bakım modundayken erişime izin verilen yollar.
     *
     * @var array<int, string>
     */
    protected $except = [
        // örnek: 'status', 'api/health'
    ];
}
