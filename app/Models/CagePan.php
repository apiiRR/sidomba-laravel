<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CagePan extends Model
{
    protected $table = 'cage_pan';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'cage_id',
        'pan_category_id',
    ];

    public function cage() 
    {
        return $this->belongsTo(Cage::class, 'cage_id');
    }

    public function panDetail() 
    {
        return $this->belongsTo(PanCategory::class, 'pan_category_id');
    }
}
