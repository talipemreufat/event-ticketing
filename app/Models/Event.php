<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'date',
        'organizer_id',
        'created_by',
        'user_id',
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function ticketTypes()
    {
        return $this -> hasMany(\App\Models\TicketType::class);
    }
}
