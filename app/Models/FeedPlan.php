<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedPlan extends Model
{
    protected $table = 'feed_plan';
    protected $primaryKey = 'feed_plan_id';
    public $timestamps = false;

    protected $fillable = [
        'phase',
        'forage_amount',
        'concentrate_amount'
    ];
}
