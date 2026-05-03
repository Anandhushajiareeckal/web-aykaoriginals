<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class HomepageSection extends Model {
    protected $table = 'homepage_sections';
    protected $fillable = ['section_key','heading','subheading','body','video_url','btn1_label','btn1_url','btn2_label','btn2_url','is_active'];
    protected $casts = ['is_active'=>'boolean'];
    public static function get(string $key): ?self { return static::where('section_key',$key)->first(); }
}
