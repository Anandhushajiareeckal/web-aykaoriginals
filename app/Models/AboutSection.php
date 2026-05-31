<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model {
    protected $table = 'about_sections';
    protected $fillable = [
        'section_key',
        'heading',
        'subheading',
        'body',
        'image_url',
        'video_url',
        'btn1_label',
        'btn1_url',
        'is_active'
    ];
    protected $casts = [
        'is_active' => 'boolean'
    ];

    public static function get(string $key): ?self { 
        return static::where('section_key', $key)->first(); 
    }
}
