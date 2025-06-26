<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sheep extends Model
{
    protected $table = 'sheep';
    protected $primaryKey = 'sheep_id';
    public $timestamps = false;

    protected $fillable = [
        'tag_number',
        'name',
        'gender',
        'birth_date',
        'breed',
        'mother_id',
        'father_id'
    ];

    // Relasi ke ibu
    public function mother()
    {
        return $this->belongsTo(Sheep::class, 'mother_id');
    }

    // Relasi ke ayah
    public function father()
    {
        return $this->belongsTo(Sheep::class, 'father_id');
    }

    // Relasi anak-anak dari domba ini sebagai ibu
    public function childrenAsMother()
    {
        return $this->hasMany(Sheep::class, 'mother_id');
    }

    // Relasi anak-anak dari domba ini sebagai ayah
    public function childrenAsFather()
    {
        return $this->hasMany(Sheep::class, 'father_id');
    }

    public function weightRecords()
    {
        return $this->hasMany(WeightRecord::class, 'sheep_id', 'sheep_id');
    }

    public function diseaseRecords()
    {
        return $this->hasMany(DiseaseRecord::class, 'sheep_id', 'sheep_id');
    }
}
