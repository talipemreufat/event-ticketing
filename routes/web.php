<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Organizer\CheckInController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🔹 Ana sayfa yönlendirmesi
Route::get('/', fn() => redirect()->route('events.index'));

// 🔹 Giriş sonrası yönlendirme
Route::get('/dashboard', function () {
    $user = Auth::user();
    if (!$user) return redirect()->route('login');
    return redirect()->route('events.index');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| 🟦 Admin Dashboard (istatistikli)
|--------------------------------------------------------------------------
| Admin tüm sistemi görebilir. Dashboard sayfası event, organizer ve ticket
| istatistiklerini gösterir.
*/
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', function () {
    $totalEvents = \App\Models\Event::count();
    $totalOrganizers = \App\Models\User::where('role', 'organizer')->count();
    $totalTickets = \App\Models\TicketType::count();

    return view('admin.dashboard', compact('totalEvents', 'totalOrganizers', 'totalTickets'));
})->name('admin.dashboard');

/*
|--------------------------------------------------------------------------
| 🟩 Organizer + Admin Rotaları
|--------------------------------------------------------------------------
| Sadece organizer ve admin etkinlik oluşturabilir, düzenleyebilir,
| ticket & order yönetimi yapabilir.
*/
Route::middleware(['auth', 'role:organizer,admin'])->group(function () {
    // Etkinlik CRUD
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

    // Ticket & Order yönetimi
    Route::resource('ticket-types', TicketTypeController::class);
    Route::resource('orders', OrderController::class);

    // Check-in ekranı
    Route::get('/check-in', [CheckInController::class, 'index'])->name('checkin.index');
    Route::post('/check-in/verify', [CheckInController::class, 'verify'])->name('checkin.verify');
});

/*
|--------------------------------------------------------------------------
| 🟨 Genel Erişim (Attendee, Organizer, Admin)
|--------------------------------------------------------------------------
| Her kullanıcı etkinlikleri görüntüleyebilir, bilet satın alabilir.
*/
Route::middleware(['auth', 'role:attendee,organizer,admin'])->group(function () {
    // Etkinlik görüntüleme
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

    // Bilet satın alma
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::post('/tickets/purchase/{id}', [TicketController::class, 'purchase'])->name('tickets.purchase');
});

/*
|--------------------------------------------------------------------------
| 🧍 Profil Yönetimi
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| 🔐 Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
