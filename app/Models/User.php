<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kitle atanabilir alanlar
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Gizli tutulacak alanlar
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Dönüştürülmesi gereken alan tipleri
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Kullanıcının organizer olup olmadığını kontrol eder.
     *
     * @return bool
     */
    public function isOrganizer(): bool
    {
        return $this->role === 'organizer';
    }

    /**
     * Kullanıcının attendee olup olmadığını kontrol eder.
     *
     * @return bool
     */
    public function isAttendee(): bool
    {
        return $this->role === 'attendee';
    }

    /**
     * Kullanıcının oluşturduğu etkinlikler (opsiyonel ilişki)
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
