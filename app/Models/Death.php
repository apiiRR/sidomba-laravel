<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Death extends Model
{
    protected $table = 'death';
    protected $primaryKey = 'death_id';
    public $timestamps = false;

    protected $fillable = [
        'sheep_id',
        'date',
        'cause'
    ];

    public function sheep()
    {
        return $this->belongsTo(Sheep::class, 'sheep_id');
    }
}
