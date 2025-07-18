<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sheep;
use App\Models\Death;
use App\Models\Breeding;
use App\Models\BreedingFeed;
use App\Models\BreedingSheep;
use App\Models\Fattening;
use App\Models\FatteningFeed;
use App\Models\FatteningSheep;
use App\Models\FatteningPan;
use App\Models\DeathRecord;
use App\Models\WeightRecord;
use App\Models\FeedPlan;
use App\Models\DiseaseRecord;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Total Sheep
        $totalSheep = Sheep::count();

        // Breeding Sheep (jumlah domba di breeding_sheep)
        $breedingSheep = BreedingSheep::count();

        // Fattening Sheep
        $fatteningSheep = Fattening::count();

        // Death Sheep
        $deathCount = Death::count();

        // Sick Sheep
        $sickSheep = DiseaseRecord::count();

        // Average Weight Gain
        $averageWeight = WeightRecord::avg('weight');

        // Total Feed Today
        $today = Carbon::today();

        $totalBreedingFeed = BreedingFeed::sum(DB::raw('forage_feed + concentrate_feed'));

        $totalFatteningFeed = FatteningFeed::sum(DB::raw('forage_feed + concentrate_feed'));

        $totalFeedToday = $totalBreedingFeed + $totalFatteningFeed;

        // Population Growth (Line Chart) - last 12 months
        $populationGrowth = Sheep::selectRaw("
                TO_CHAR(DATE_TRUNC('month', birth_date), 'YYYY-MM') AS month,
                COUNT(*) AS total
            ")
            ->whereNotNull('birth_date')
            ->where('birth_date', '>=', now()->subMonths(12)->startOfMonth())
            ->groupByRaw("DATE_TRUNC('month', birth_date)")
            ->orderByRaw("DATE_TRUNC('month', birth_date)")
            ->get();

        $labelsPopulationGrowth = $populationGrowth->pluck('month');
        $dataPopulationGrowth = $populationGrowth->pluck('total');

        // Breeding vs Fattening Trend (Stacked Bar Chart)
        $breedingTrend = Breeding::select(
                DB::raw("TO_CHAR(DATE_TRUNC('month', date_started), 'YYYY-MM') as month"),
                DB::raw('COUNT(*) as total')
            )
            ->where('date_started', '>=', Carbon::now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $fatteningTrend = Fattening::select(
                DB::raw("TO_CHAR(DATE_TRUNC('month', date_started), 'YYYY-MM') as month"),
                DB::raw('COUNT(*) as total')
            )
            ->where('date_started', '>=', Carbon::now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Feed Consumption (Bar Chart for last 7 days)
        $feedConsumption = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();

            $breedingFeed = BreedingFeed::whereDate('date', $date)
                ->sum(DB::raw('forage_feed + concentrate_feed'));

            $fatteningFeed = FatteningFeed::whereDate('date', $date)
                ->sum(DB::raw('forage_feed + concentrate_feed'));

            $feedConsumption[] = [
                'date' => $date,
                'breeding' => $breedingFeed,
                'fattening' => $fatteningFeed,
            ];
        }

        // Disease Trend (Bar Chart)
        $sicknessTrend = DiseaseRecord::select(
                DB::raw("TO_CHAR(DATE_TRUNC('month', date), 'YYYY-MM') as month"),
                DB::raw('COUNT(*) as total')
            )
            ->where('date', '>=', Carbon::now()->subMonths(12))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Mortality Pie
        $mortalityPie = Death::select('cause', DB::raw('COUNT(*) as total'))
            ->groupBy('cause')
            ->get();

        // Recent Death Record Table
        $recentDeaths = Death::orderBy('date', 'desc')->take(10)->get();

        // Recent Disease Record Table
        $recentDiseases = DiseaseRecord::orderBy('date', 'desc')->take(10)->get();

        // Random colors untuk card
        $randomColors = $this->generateRandomColors(10);

        // AVG Start
        $adgList = [];

        $fatteningSheepRecords = FatteningSheep::with([
            'sheep.weightRecords',
            'fatteningPan.fattening'
        ])->get();

        foreach ($fatteningSheepRecords as $record) {
            $sheep = $record->sheep;
            $pan = $record->fatteningPan;
            $fattening = $pan->fattening;

            $startDate = Carbon::parse($fattening->date_started);
            $endDate = Carbon::parse($fattening->date_ended);

            // Ambil berat awal berdasarkan pan
            $startWeight = $sheep->weightRecords()
                ->whereDate('date', '>=', $startDate->copy()->subDays(2))
                ->whereDate('date', '<=', $startDate->copy()->addDays(3))
                ->orderBy('date', 'asc')
                ->value('weight');

            // Ambil berat akhir berdasarkan pan
            $endWeight = $sheep->weightRecords()
                ->whereDate('date', '>=', $endDate->copy()->subDays(3))
                ->whereDate('date', '<=', $endDate->copy()->addDays(2))
                ->orderBy('date', 'desc')
                ->value('weight');

            // Hitung ADG
            if ($startWeight !== null && $endWeight !== null) {
                $days = $startDate->diffInDays($endDate);
                if ($days > 0) {
                    $adg = ($endWeight - $startWeight) / $days;
                    $adgList[] = $adg;
                }
            }
        }

        $averageADG = count($adgList) > 0 ? round(array_sum($adgList) / count($adgList), 2) : 0;

        // AVG END

        // START Pie Chart By Gander
        $genderDistribution = Sheep::select('gender', DB::raw('COUNT(*) as total'))
        ->groupBy('gender')
        ->get();

        // Pisahkan menjadi array label dan data untuk Chart.js
        $genderLabels = $genderDistribution->pluck('gender');
        $genderTotals = $genderDistribution->pluck('total');
        // END PIE CHART

        return view('dashboard', compact(
            'totalSheep',
            'breedingSheep',
            'fatteningSheep',
            'deathCount',
            'sickSheep',
            'averageWeight',
            'totalFeedToday',
            'labelsPopulationGrowth',
            'dataPopulationGrowth',
            'breedingTrend',
            'fatteningTrend',
            'feedConsumption',
            'sicknessTrend',
            'mortalityPie',
            'recentDeaths',
            'recentDiseases',
            'randomColors',
            'averageADG',
            'genderLabels',
            'genderTotals'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function generateRandomColors($count)
    {
        $colors = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'dark'];

        // Shuffle langsung
        shuffle($colors);

        // Jika warna cukup
        if ($count <= count($colors)) {
            return array_slice($colors, 0, $count);
        }

        // Jika warna kurang, kita ulangi warna sampai cukup
        $result = $colors;
        while (count($result) < $count) {
            $tempColors = $colors;
            shuffle($tempColors);
            $result = array_merge($result, $tempColors);
        }

        return array_slice($result, 0, $count);
    }
}
