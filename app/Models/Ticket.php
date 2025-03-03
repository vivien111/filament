<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
        'assigned_to',
    ];

    // Relation avec l'utilisateur qui a créé le ticket
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec l'administrateur ou l'entreprise assigné
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    // Relation avec les messages du ticket
    public function messages()
    {
        return $this->hasMany(TicketMessage::class);
    }
}