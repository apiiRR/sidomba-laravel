<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BreedingFeed extends Model
{
    protected $table = 'breeding_feed';
    protected $primaryKey = 'breeding_feed_id';
    public $timestamps = false;

    protected $fillable = [
        'breeding_id',
        'forage_feed',
        'concentrate_feed',
        'date'
    ];

    public function breeding()
    {
        return $this->belongsTo(Breeding::class, 'breeding_id');
    }
}
