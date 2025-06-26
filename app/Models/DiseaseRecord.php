<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiseaseRecord extends Model
{
    protected $table = 'disease_record';
    protected $primaryKey = 'disease_record_id';
    public $timestamps = false;

    protected $fillable = [
        'sheep_id',
        'disease_name',
        'description',
        'treatment',
        'date'
    ];

    public function sheep()
    {
        return $this->belongsTo(Sheep::class, 'sheep_id');
    }
}
