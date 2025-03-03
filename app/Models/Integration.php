<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Integration extends Model
{
    use HasFactory;

    protected $fillable = ['service_name', 'api_key', 'status', 'logo']; // Ajoutez 'logo' dans les champs fillable

    // Vous pouvez ajouter une méthode pour obtenir l'URL de l'image si nécessaire
    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/logos/' . $this->logo) : null; // Si le logo existe, retournez l'URL
    }
}
