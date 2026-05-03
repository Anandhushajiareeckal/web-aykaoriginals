<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TalentWork extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['talent_id', 'title', 'description', 'order'];

    public function talent()
    {
        return $this->belongsTo(Talent::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->width(400)->height(500)->sharpen(10)->nonQueued();
        $this->addMediaConversion('large')->width(1200)->sharpen(10)->nonQueued();
    }
}
