<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    /**
     * Les colonnes qui peuvent être massivement assignées.
     *
     * @var array
     */
    protected $fillable = [
        'name',       // Nom du lead
        'email',      // Email du lead
        'phone',      // Téléphone du lead
        'company',    // Entreprise du lead
        'notes',      // Notes supplémentaires
    ];
}