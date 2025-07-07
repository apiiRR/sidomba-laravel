<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Breeding;
use App\Models\Sheep;

class BreedingSheep extends Model
{
    protected $table = 'breeding_sheep';
    protected $primaryKey = 'breeding_sheep_id';
    public $timestamps = false;

    protected $fillable = [
        'sheep_id',
        'breeding_pan_id'
    ];

    // Relasi ke sheep
    public function sheep()
    {
        return $this->belongsTo(Sheep::class, 'sheep_id');
    }

    public function breedingPan()
    {
        return $this->belongsTo(BreedingPan::class, 'breeding_pan_id');
    }
}