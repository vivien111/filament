<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salarie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'entreprise_id', // Lien vers l'entreprise
        'user_id', // Lien vers l'utilisateur associé
        'is_active', // Ajoutez cette ligne

    ];

    // Relation avec le modèle Entreprise
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}