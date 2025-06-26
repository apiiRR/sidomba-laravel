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
        'code',
        'name',
        'type'
    ];

    public function breeding()
    {
        return $this->hasMany(Breeding::class, 'cage_id')->with('breedingSheep');
    }

    public function fattening()
    {
        return $this->hasMany(Fattening::class, 'cage_id')->with('sheep');
    }

    public function allSheeps()
    {
        if ($this->type === 'breeding') {
            // Ambil semua sheep dari breedingSheep
            return $this->breeding
                ->flatMap(function ($b) {
                    return $b->breedingSheep->pluck('sheep');
                });
        }

        if ($this->type === 'fattening') {
            // Ambil semua sheep dari fattening
            return $this->fattening->pluck('sheep');
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

        $activeFattening = $this->fattening()
            ->where('date_started', '<=', $today)
            ->where(function ($q) use ($today) {
                $q->where('date_ended', '>=', $today)
                ->orWhereNull('date_ended');
            })
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
