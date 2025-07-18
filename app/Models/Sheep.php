<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'mother_id',
        'father_id',
        'pregnant_id',
        'image'
    ];

    public function breedingSheep()
    {
        return $this->hasMany(BreedingSheep::class, 'sheep_id');
    }

    public function fatteningSheep()
    {
        return $this->hasMany(FatteningSheep::class, 'sheep_id');
    }

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

    public function death()
    {
        return $this->hasOne(Death::class, 'sheep_id', 'sheep_id');
    }

   public function childCategories()
    {
        return $this->hasMany(ChildCategorySheep::class, 'sheep_id', 'sheep_id');
    }

    // Jika domba ini adalah hasil kehamilan dari induk
    public function pregnancy()
    {
        return $this->belongsTo(Pregnant::class, 'pregnant_id');
    }

    // Jika domba ini adalah induk dengan banyak kehamilan
    public function pregnancies()
    {
        return $this->hasMany(Pregnant::class, 'sheep_id');
    }

    public function getAgeAttribute()
    {
        $birth = Carbon::parse($this->birth_date);
        $diff = $birth->diff(Carbon::now());

        return $diff->m . ' Bulan, ' . $diff->d . ' Hari';
    }

    public function getPregnancyOrderAttribute()
    {
        if (!$this->pregnant_id || !$this->mother) {
            return null;
        }

        $pregnancies = Pregnant::where('sheep_id', $this->mother_id)
            ->orderBy('date_started')
            ->pluck('pregnant_id')
            ->toArray();

        return array_search($this->pregnant_id, $pregnancies) + 1;
    }

    public function phaseHistory()
    {
        $phases = collect();

        // Ambil semua data breeding
        foreach ($this->breedingSheep as $breedingSheep) {
            $breedingPan = $breedingSheep->breedingPan;
            $breeding = $breedingPan?->breeding;

            if ($breeding) {
                $phases->push([
                    'phase' => 'Breeding',
                    'date_started' => $breeding->date_started,
                    'date_ended' => $breeding->date_ended,
                    'cage' => $breeding->cage->mitra_name,
                    'pan' => $breedingPan->panCategory->category_name,
                    'phase_sheep_id' => $breedingSheep->breeding_sheep_id,
                    'is_active' => Carbon::now()->between(
                        $breeding->date_started,
                        $breeding->date_ended ?? Carbon::now()
                    ),
                ]);
            }
        }

        // Ambil semua data fattening
        foreach ($this->fatteningSheep as $fatteningSheep) {
            $fatteningPan = $fatteningSheep->fatteningPan;
            $fattening = $fatteningPan?->fattening;

            if ($fattening) {
                $phases->push([
                    'phase' => 'Fattening',
                    'date_started' => $fattening->date_started,
                    'date_ended' => $fattening->date_ended,
                    'cage' => $fattening->cage->mitra_name,
                    'pan' => $fatteningPan->panCategory->category_name,
                    'phase_sheep_id' => $fatteningSheep->fattening_sheep_id,
                    'is_active' => Carbon::now()->between(
                        $fattening->date_started,
                        $fattening->date_ended ?? Carbon::now()
                    ),
                ]);
            }
        }

        // Hilangkan duplikasi berdasarkan kombinasi phase + tanggal mulai + tanggal akhir
        return $phases->unique(function ($item) {
            return $item['phase'] . $item['date_started'] . $item['date_ended'];
        })->sortByDesc('date_started')->values();
    }
    
}

