<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';

    protected $fillable = [
        'name',
        'catering_name',
        'no_of_persons',
        'email',
        'phone_number',
        'location',
        'note'
    ];
}
