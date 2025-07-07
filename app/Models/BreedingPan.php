<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BreedingPan extends Model
{
    protected $table = 'breeding_pan';
    protected $primaryKey = 'breeding_pan_id';
    public $timestamps = false;

    protected $fillable = [
        'pan_category_id',
        'breeding_id',
    ];

    public function breeding()
    {
        return $this->belongsTo(Breeding::class, 'breeding_id');
    }

    public function panCategory()
    {
        return $this->belongsTo(PanCategory::class, 'pan_category_id');
    }

    public function breedingSheep()
    {
        return $this->hasMany(BreedingSheep::class, 'breeding_pan_id');
    }

    public function breedingFeeds()
    {
        return $this->hasMany(BreedingFeed::class, 'breeding_pan_id');
    }
}
