<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class GalleryItem extends Model implements HasMedia {
    use InteractsWithMedia;
    protected $table = 'gallery_items';
    protected $fillable = ['title','category','sort_order','is_active'];
    protected $casts = ['is_active'=>'boolean'];
    public function scopeActive($q) { return $q->where('is_active',true); }
    public function registerMediaCollections(): void { $this->addMediaCollection('image')->singleFile(); }
    public function registerMediaConversions(?Media $media=null): void {
        $this->addMediaConversion('medium')->width(800)->format('webp')->quality(85)->nonQueued();
        $this->addMediaConversion('large')->width(1600)->format('webp')->quality(90)->nonQueued();
        $this->addMediaConversion('thumb')->width(400)->format('webp')->quality(85)->nonQueued();
    }
}
