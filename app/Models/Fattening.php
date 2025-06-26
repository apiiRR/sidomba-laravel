<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fattening extends Model
{
    protected $table = 'fattening';
    protected $primaryKey = 'fattening_id';
    public $timestamps = false;

    protected $fillable = [
        'sheep_id',
        'cage_id',
        'date_started',
        'date_ended'
    ];

    public function sheep()
    {
        return $this->belongsTo(Sheep::class, 'sheep_id');
    }

    public function cage()
    {
        return $this->belongsTo(Cage::class, 'cage_id');
    }

    public function fatteningFeeds()
    {
        return $this->hasMany(FatteningFeed::class, 'fattening_id');
    }
}
