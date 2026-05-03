<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Page extends Model {
    protected $table = 'pages';
    protected $fillable = ['title','slug','content','meta_title','meta_description','is_active','sort_order','template'];
    protected $casts = ['is_active'=>'boolean'];
    protected static function boot(): void {
        parent::boot();
        static::creating(function(self $p) {
            if(empty($p->slug)) $p->slug = Str::slug($p->title);
        });
    }
    public function getRouteKeyName(): string { return 'slug'; }
    public function scopeActive($q) { return $q->where('is_active',true); }
}
