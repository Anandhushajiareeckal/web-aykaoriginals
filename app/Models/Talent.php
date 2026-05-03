<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Talent extends Model implements HasMedia {
    use HasFactory, InteractsWithMedia;
    protected $table = 'talents';
    protected $fillable = [
        'user_id', 'type', 'name', 'slug', 'category', 'gender', 'location', 
        'height', 'chest_bust', 'waist', 'hips', 'weight', 'inseam', 'shoe_size', 
        'eye_color', 'hair_color', 'bio', 'social_links', 'status', 'is_active', 
        'completeness_score', 'is_featured'
    ];

    public function scopeModels($q) { return $q->where('type', 'model'); }
    public function scopeTalents($q) { return $q->where('type', 'talent'); }

    protected $casts = [
        'is_featured'       => 'boolean',
        'is_active'         => 'boolean',
        'social_links'      => 'array',
        'last_active_at'    => 'datetime',
    ];

    protected static function boot(): void {
        parent::boot();
        static::creating(function(self $t) { if(empty($t->slug)) $t->slug = Str::slug($t->name); });
    }

    public function getRouteKeyName(): string { return 'slug'; }

    public function highlightWorks()
    {
        return $this->hasMany(TalentWork::class)->orderBy('order');
    }

    public function user() { return $this->belongsTo(User::class); }

    public function registerMediaCollections(): void {
        $this->addMediaCollection('profile')->singleFile();
        $this->addMediaCollection('cover')->singleFile();
        $this->addMediaCollection('portfolio');
        $this->addMediaCollection('comp_card');
    }

    public function registerMediaConversions(?Media $media=null): void {
        $this->addMediaConversion('thumb')
             ->width(300)->format('webp')->quality(85)
             ->performOnCollections('profile','portfolio','comp_card','cover')->nonQueued();
        $this->addMediaConversion('medium')
             ->width(800)->format('webp')->quality(85)
             ->performOnCollections('profile','portfolio','comp_card','cover')->nonQueued();
        $this->addMediaConversion('large')
             ->width(1600)->format('webp')->quality(90)
             ->performOnCollections('profile','portfolio','comp_card','cover')->nonQueued();
    }

    /** Compute and return profile completeness percentage (0-100) */
    public function computeCompleteness(): int {
        $fields = [
            'name'       => 15,
            'bio'        => 10,
            'location'   => 5,
            'gender'     => 5,
            'category'   => 5,
            'height'     => 5,
            'chest_bust' => 5,
            'waist'      => 5,
            'hips'       => 5,
            'shoe_size'  => 5,
            'eye_color'  => 5,
            'hair_color' => 5,
        ];
        $score = 0;
        foreach ($fields as $field => $weight) {
            if (!empty($this->$field)) $score += $weight;
        }
        // Profile photo = 15 points
        if ($this->hasMedia('profile')) $score += 15;
        // Social link = 5 points
        if (!empty($this->social_links)) $score += 5;
        return min(100, $score);
    }

    public function scopeActive($query) { return $query->where('is_active',true); }
    public function scopeFeatured($query) { return $query->where('is_featured',true); }
    public function scopeApproved($query) { return $query->where('status','approved'); }
    public function scopeFilter($query, array $filters) {
        $query->when($filters['gender']??null, fn($q,$v)=>$q->where('gender',$v));
        $query->when($filters['category']??null, fn($q,$v)=>$q->where('category',$v));
        $query->when($filters['location']??null, fn($q,$v)=>$q->where('location','like',"%{$v}%"));
    }
}
