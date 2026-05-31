<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Service extends Model {
    protected $table = 'services';
    protected $fillable = ['title','slug','description','content','icon','image_url','banner_image','tag','sort_order','is_active'];
    protected $casts = ['is_active'=>'boolean'];
    public function scopeActive($q) { return $q->where('is_active',true); }
}
