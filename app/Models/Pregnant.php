<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pregnant extends Model
{
    protected $table = 'pregnant';
    protected $primaryKey = 'pregnant_id';
    public $timestamps = false;

    protected $fillable = [
        'sheep_id',
        'date_started',
        'date_ended'
    ];

    public function mother()
    {
        return $this->belongsTo(Sheep::class, 'sheep_id');
    }

    public function children()
    {
        return $this->hasMany(Sheep::class, 'pregnant_id');
    }
}
