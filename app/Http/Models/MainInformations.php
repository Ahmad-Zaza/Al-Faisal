<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class MainInformations extends Model
{
    protected $table="main_info";

    protected $fillable = [
        'tel_number',
        'tel_number1',
        'mob_number',
        'main_address_ar',
        'main_address_en',
        'sub_address_ar',
        'sub_address_en',
        'event',
        'active',
        'sorting'
    ];
}
