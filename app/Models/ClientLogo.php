<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class ClientLogo extends Model implements HasMedia {
    use InteractsWithMedia;
    protected $table = 'client_logos';
    protected $fillable = ['name','sort_order','is_active'];
    protected $casts = ['is_active'=>'boolean'];
    public function scopeActive($q){ return $q->where('is_active',true); }
    public function registerMediaCollections(): void { $this->addMediaCollection('logo')->singleFile(); }
    public function registerMediaConversions(?Media $media=null): void {
        $this->addMediaConversion('thumb')->width(200)->format('webp')->quality(90)->nonQueued();
    }
}
