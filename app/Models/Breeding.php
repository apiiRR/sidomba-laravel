<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Breeding extends Model
{
    protected $table = 'breeding';
    protected $primaryKey = 'breeding_id';
    public $timestamps = false;

    protected $fillable = [
        'cage_id',
        'date_started',
        'date_ended'
    ];

    public function cage()
    {
        return $this->belongsTo(Cage::class, 'cage_id');
    }

    public function breedingFeeds()
    {
        return $this->hasMany(BreedingFeed::class, 'breeding_id');
    }

    public function breedingSheep()
    {
        return $this->hasMany(BreedingSheep::class, 'breeding_id')->with('sheep');
    }
}
