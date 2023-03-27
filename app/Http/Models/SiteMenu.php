<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class SiteMenu extends Model
{
    protected $table = 'site_menu';

    protected $fillable = [
        'id',
        'name_ar',
        'name_en',
        'section',
        'is_download_menu',
        'is_drop_down_menu',
        'download_link',
        'active',
        'sorting',
        'created_at',
        'updated_at'
    ];
}
