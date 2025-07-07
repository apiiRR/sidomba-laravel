<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BreedingFeed extends Model
{
    protected $table = 'breeding_feed';
    protected $primaryKey = 'breeding_feed_id';
    public $timestamps = false;

    protected $fillable = [
        'forage_feed',
        'concentrate_feed',
        'date',
        'concentrate_category_id',
        'breeding_pan_id'
    ];

    public function breedingPan()
    {
        return $this->belongsTo(BreedingPan::class, 'breeding_pan_id');
    }

    public function concentrateCategory()
    {
        return $this->belongsTo(ConsentrateCategory::class, 'concentrate_category_id');
    }
}
