<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ChildCategorySheep extends Model
{
    protected $table = 'child_category_sheep';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'sheep_id',
        'child_category_id',
        'date_started',
        'date_ended'
    ];

    public function sheep()
    {
        return $this->belongsTo(Sheep::class, 'sheep_id');
    }

    public function childCategory()
    {
        return $this->belongsTo(ChildCategory::class, 'child_category_id');
    }

    public function getIsActiveAttribute()
    {
        $today = Carbon::today();

        return $this->date_started <= $today && $this->date_ended >= $today;
    }
}
