<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return redirect()->route('events.index');
});

// 💡 Giriş sonrası yönlendirme (dashboard)
Route::get('/dashboard', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    // Her iki rol de event listesine yönlendiriliyor
    return redirect()->route('events.index');
})->middleware(['auth'])->name('dashboard');

// 🟢 Attendee + Organizer → etkinlikleri görüntüleyebilir, bilet alabilir
Route::middleware(['auth', 'role:attendee,organizer'])->group(function () {
    // ⚠️ “create” ve “edit” rotaları her zaman {event}’den ÖNCE gelmeli!
    Route::get('/events/create', [EventController::class, 'create'])
        ->middleware('role:organizer')
        ->name('events.create');

    Route::post('/events', [EventController::class, 'store'])
        ->middleware('role:organizer')
        ->name('events.store');

    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

    // Bilet işlemleri
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::post('/tickets/purchase/{id}', [TicketController::class, 'purchase'])->name('tickets.purchase');
});

// 🔵 Organizer → Etkinlik düzenleme, silme, bilet & sipariş yönetimi
Route::middleware(['auth', 'role:organizer'])->group(function () {
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

    Route::resource('ticket-types', TicketTypeController::class);
    Route::resource('orders', OrderController::class);
});

// 🔸 Her kullanıcı (login olmuş herkes) → profilini düzenleyebilir
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
});
Route::middleware(['auth', 'role:organizer'])->group(function () {
    Route::get('/check-in', [\App\Http\Controllers\Organizer\CheckInController::class, 'index'])->name('checkin.index');
    Route::post('/check-in/verify', [\App\Http\Controllers\Organizer\CheckInController::class, 'verify'])->name('checkin.verify');
});

require __DIR__ . '/auth.php';
