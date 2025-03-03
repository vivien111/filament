<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'email',
        'adresse',
        'user_id', // Lien vers l'utilisateur associé
    ];

    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec les salariés
    public function salaries()
    {
        return $this->hasMany(Salarie::class);
    }
}