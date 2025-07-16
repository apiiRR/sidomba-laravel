<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cage extends Model
{
    protected $table = 'cage';
    protected $primaryKey = 'cage_id';
    public $timestamps = false;

    protected $fillable = [
        'mitra_name',
        'image'
    ];

    public function breeding()
    {
        return $this->hasMany(Breeding::class, 'cage_id')->with('breedingPans.breedingSheep.sheep');
    }

    public function fattening()
    {
        return $this->hasMany(Fattening::class, 'cage_id')->with('fatteningPans.fatteningSheep.sheep');
    }

    public function pan()
    {
        return $this->hasMany(CagePan::class, 'cage_id', 'cage_id');
    }

    public function allSheeps()
    {
        if ($this->type === 'breeding') {
            return $this->breeding
                ->flatMap(function ($breeding) {
                    return $breeding->breedingPans
                        ->flatMap(function ($pan) {
                            return $pan->breedingSheep->pluck('sheep');
                        });
                });
        }

        if ($this->type === 'fattening') {
            return $this->fattening
                ->flatMap(function ($fattening) {
                    return $fattening->fatteningPans
                        ->flatMap(function ($pan) {
                            return $pan->fatteningSheep->pluck('sheep');
                        });
                });
        }

        return collect();
    }

    public function getActivePhaseAttribute()
    {
        $today = Carbon::today();

        $activeBreeding = $this->breeding()
            ->where('date_started', '<=', $today)
            ->where('date_ended', '>=', $today)
            ->first();

        if ($activeBreeding) {
            return [
                'name' => 'Breeding',
                'id' => $activeBreeding->breeding_id,
            ];
        }

        $activeFattening = $this->breeding()
            ->where('date_started', '<=', $today)
            ->where('date_ended', '>=', $today)
            ->first();

        if ($activeFattening) {
            return [
                'name' => 'Fattening',
                'id' => $activeFattening->fattening_id,
            ];
        }

        return [
            'name' => '-',
            'id' => null,
        ];
    }
}
