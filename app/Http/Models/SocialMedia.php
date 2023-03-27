<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $table = 'social_media';

    protected $fillable = [
        'facebook_link',
        'youtube_link',
        'instagram_link',
        'active',
        'sorting'
    ];
}
