<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'email',
        'city_id',
        'frequency',
        'confirmation_token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
