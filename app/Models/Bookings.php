<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookings extends Model
{
    protected $fillable=[
        'package_id',
        'customer_name',
        'customer_email',
        'travel_date',
    ];
    protected $casts=[
        'travel_date'=>'datetime'
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }
}
