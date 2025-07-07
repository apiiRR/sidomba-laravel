<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function breedingPans()
    {
        return $this->hasMany(BreedingPan::class, 'breeding_id');
    }

    public function breedingFeeds()
    {
        return $this->hasManyThrough(
            BreedingFeed::class,
            BreedingPan::class,
            'breeding_id',
            'breeding_pan_id'
        );
    }

    public function getIsActiveAttribute()
    {
        $today = Carbon::today();

        return $this->date_started <= $today && $this->date_ended >= $today;
    }
}
