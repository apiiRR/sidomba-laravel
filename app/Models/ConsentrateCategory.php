<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsentrateCategory extends Model
{
    protected $table = 'concentrate_category';
    protected $primaryKey = 'concentrate_category_id';
    public $timestamps = false;

    protected $fillable = [
        'category_name'
    ];

    public function breedingFeeds()
    {
        return $this->hasMany(BreedingFeed::class, 'concentrate_category_id');
    }

    public function fatteningFeeds()
    {
        return $this->hasMany(FatteningFeed::class, 'concentrate_category_id');
    }
}
