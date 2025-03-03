<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'ticket_id',
        'user_id',
    ];

    // Relation avec le ticket
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    // Relation avec l'utilisateur ou l'entreprise qui a envoyé le message
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}