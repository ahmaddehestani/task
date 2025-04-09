<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    protected $fillable = [
        'name',
        'price',
        'location',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Bookings::class);
    }
    public function scopeBookingsCount()
    {
        return $this->bookings()->count();
    }
}
