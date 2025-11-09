<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public function user()
{
    return $this->belongsTo(User::class);
}

public function ticketType()
{
    return $this->belongsTo(TicketType::class);
}

}
