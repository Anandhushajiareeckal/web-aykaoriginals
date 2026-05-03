<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia {
    use HasFactory, InteractsWithMedia;
    protected $table = 'projects';
    protected $fillable = ['brand','slug','year','service_type','description','is_featured','is_active'];
    protected $casts = ['is_featured'=>'boolean','is_active'=>'boolean'];
    protected static function boot(): void {
        parent::boot();
        static::creating(function(self $p) { if(empty($p->slug)) $p->slug = Str::slug($p->brand.'-'.$p->year); });
    }
    public function getRouteKeyName(): string { return 'slug'; }
    public function registerMediaCollections(): void { $this->addMediaCollection('gallery'); }
    public function registerMediaConversions(?Media $media=null): void {
        $this->addMediaConversion('thumb')->width(300)->format('webp')->quality(85)->performOnCollections('gallery')->nonQueued();
        $this->addMediaConversion('medium')->width(800)->format('webp')->quality(85)->performOnCollections('gallery')->nonQueued();
        $this->addMediaConversion('large')->width(1600)->format('webp')->quality(90)->performOnCollections('gallery')->nonQueued();
    }
    public function scopeActive($query) { return $query->where('is_active',true); }
    public function scopeFeatured($query) { return $query->where('is_featured',true); }
}
