<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function getIsActiveAttribute()
    {
        $today = Carbon::today();

        return $this->date_started <= $today && $this->date_ended >= $today;
    }
}
