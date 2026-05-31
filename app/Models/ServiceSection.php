<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ServiceSection extends Model {
    protected $fillable = [
        'section_key', 'heading', 'subheading', 'body',
        'image_url', 'video_url', 'btn1_label', 'btn1_url', 'is_active'
    ];
}
