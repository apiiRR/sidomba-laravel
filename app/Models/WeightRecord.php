<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeightRecord extends Model
{
    protected $table = 'weight_record';
    protected $primaryKey = 'weight_record_id';
    public $timestamps = false;

    protected $fillable = [
        'sheep_id',
        'weight',
        'date'
    ];

    public function sheep()
    {
        return $this->belongsTo(Sheep::class, 'sheep_id');
    }
}
