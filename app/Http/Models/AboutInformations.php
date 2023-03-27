<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class AboutInformations extends Model
{
    protected $table = 'about_info';

    protected $fillable = [
        'id',
        'info_name_ar',
        'info_name_en',
        'info_count',
        'sorting',
        'active'
    ];
}
