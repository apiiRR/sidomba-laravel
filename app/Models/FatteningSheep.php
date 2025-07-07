<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FatteningSheep extends Model
{
    protected $table = 'fattening_sheep';
    protected $primaryKey = 'fattening_sheep_id';
    public $timestamps = false;

    protected $fillable = [
        'sheep_id',
        'fattening_pan_id'
    ];

    // Relasi ke sheep
    public function sheep()
    {
        return $this->belongsTo(Sheep::class, 'sheep_id');
    }

    public function fatteningPan()
    {
        return $this->belongsTo(FatteningPan::class, 'fattening_pan_id');
    }
}
