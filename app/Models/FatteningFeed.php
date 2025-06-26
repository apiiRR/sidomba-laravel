<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FatteningFeed extends Model
{
    protected $table = 'fattening_feed';
    protected $primaryKey = 'fattening_feed_id';
    public $timestamps = false;

    protected $fillable = [
        'fattening_id',
        'forage_feed',
        'concentrate_feed',
        'date'
    ];

    public function fattening()
    {
        return $this->belongsTo(Fattening::class, 'fattening_id');
    }
}
