<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FatteningPan extends Model
{
    protected $table = 'fattening_pan';
    protected $primaryKey = 'fattening_pan_id';
    public $timestamps = false;

    protected $fillable = [
        'pan_category_id',
        'fattening_id',
    ];

    public function fattening()
    {
        return $this->belongsTo(Fattening::class, 'fattening_id');
    }

    public function panCategory()
    {
        return $this->belongsTo(PanCategory::class, 'pan_category_id');
    }

    public function fatteningSheep()
    {
        return $this->hasMany(FatteningSheep::class, 'fattening_pan_id');
    }

    public function fatteningFeeds()
    {
        return $this->hasMany(FatteningFeed::class, 'fattening_pan_id');
    }
}
