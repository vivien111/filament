<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    // Allow mass assignment for these attributes
    protected $fillable = [
        'user_id',             // If you want to mass assign the user_id as well
        'stripe_subscription_id',
        'stripe_status',
    ];
}
