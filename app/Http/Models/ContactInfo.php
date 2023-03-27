<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $table = 'contact_info';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'message',
        'active',
        'address',
        'sorting',
        'created_at',
        'updated_at'
    ];
}
