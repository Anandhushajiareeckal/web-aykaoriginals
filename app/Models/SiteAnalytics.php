<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class SiteAnalytics extends Model {
    protected $table = 'site_analytics';
    protected $fillable = ['date','total_views','unique_visitors'];
    protected $casts = ['date'=>'date'];
}
