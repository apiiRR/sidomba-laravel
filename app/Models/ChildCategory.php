<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    protected $table = 'child_category';
    protected $primaryKey = 'child_category_id';
    public $timestamps = false;

    protected $fillable = [
        'category_name'
    ];

    public function childCategorySheep()
    {
        return $this->hasMany(ChildCategorySheep::class, 'child_category_id');
    }
}
