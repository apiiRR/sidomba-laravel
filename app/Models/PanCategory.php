<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanCategory extends Model
{
    protected $table = 'pan_category';
    protected $primaryKey = 'pan_category_id';
    public $timestamps = false;

    protected $fillable = [
        'category_name'
    ];

    public function breedingPans()
    {
        return $this->hasMany(BreedingPan::class, 'pan_category_id');
    }
}
