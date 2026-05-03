<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model {
    use HasFactory;
    protected $table = 'inquiries';
    protected $fillable = ['name','email','company','type','message','budget','talent_id','status','admin_approved','admin_approved_at'];
    protected $casts = ['admin_approved' => 'boolean', 'admin_approved_at' => 'datetime'];
    public function talent() { return $this->belongsTo(Talent::class); }
}

