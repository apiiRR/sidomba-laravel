<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FatteningFeed extends Model
{
    protected $table = 'fattening_feed';
    protected $primaryKey = 'fattening_feed_id';
    public $timestamps = false;

    protected $fillable = [
        'forage_feed',
        'concentrate_feed',
        'date',
        'concentrate_category_id',
        'fattening_pan_id'
    ];

    public function fatteningPan()
    {
        return $this->belongsTo(FatteningPan::class, 'fattening_pan_id');
    }

    public function concentrateCategory()
    {
        return $this->belongsTo(ConcentrateCategory::class, 'concentrate_category_id');
    }
}
