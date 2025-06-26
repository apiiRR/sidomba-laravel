<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Breeding;
use App\Models\Sheep;

class BreedingSheep extends Model
{
    protected $table = 'breeding_sheep';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'breeding_id',
        'sheep_id',
    ];

    // Relasi ke breeding
    public function breeding()
    {
        return $this->belongsTo(Breeding::class, 'breeding_id');
    }

    // Relasi ke sheep
    public function sheep()
    {
        return $this->belongsTo(Sheep::class, 'sheep_id');
    }
}