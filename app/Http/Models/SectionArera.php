<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class SectionArera extends Model
{
    protected $table = 'sections_area';

    protected $fillable = [
        'id',
        'first_box_title_ar',
        'first_box_para_ar',
        'first_box_title_en',
        'first_box_para_en',
        'second_box_title_ar',
        'second_box_para_ar',
        'second_box_title_en',
        'second_box_para_en',
        'image',
        'image_alt',
        'section_id',
        'sorting',
        'active'
    ];

    public function section(){
        return $this->belongsTo(Section::class, 'section_id');
    }
}
