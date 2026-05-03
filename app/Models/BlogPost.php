<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class BlogPost extends Model implements HasMedia {
    use InteractsWithMedia;
    protected $table = 'blog_posts';
    protected $fillable = ['title','slug','excerpt','content','category','is_active','published_at'];
    protected $casts = ['is_active'=>'boolean','published_at'=>'datetime'];
    protected static function boot(): void {
        parent::boot();
        static::creating(function(self $p) {
            if(empty($p->slug)) $p->slug = Str::slug($p->title);
        });
    }
    public function getRouteKeyName(): string { return 'slug'; }
    public function scopeActive($q) { return $q->where('is_active',true); }
    public function registerMediaCollections(): void { $this->addMediaCollection('cover')->singleFile(); }
    public function registerMediaConversions(?Media $media=null): void {
        $this->addMediaConversion('medium')->width(800)->format('webp')->quality(85)->nonQueued();
        $this->addMediaConversion('thumb')->width(400)->format('webp')->quality(85)->nonQueued();
    }
}
