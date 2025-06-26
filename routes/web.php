<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DombaController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\BreedingController;
use App\Http\Controllers\FatteningController;
use App\Http\Controllers\DeathController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index']);

Route::get('/domba', [DombaController::class, 'index'])->name('domba.index');
Route::get('/domba/input', [DombaController::class, 'create'])->name('domba.input');
Route::get('/domba/inputWeight/{id}', [DombaController::class, 'createWeight'])->name('domba.inputWeight');
Route::get('/domba/inputDisease/{id}', [DombaController::class, 'createDisease'])->name('domba.inputDisease');
Route::get('/domba/{id}', [DombaController::class, 'show'])->name('domba.show');
Route::post('/domba/store', [DombaController::class, 'store'])->name('domba.store');
Route::post('/domba/storeWeight', [DombaController::class, 'storeWeight'])->name('domba.storeWeight');
Route::post('/domba/storeDisease', [DombaController::class, 'storeDisease'])->name('domba.storeDisease');
Route::get('/domba/edit/{id}', [DombaController::class, 'edit'])->name('domba.edit');
Route::put('/domba/update/{id}', [DombaController::class, 'update'])->name('domba.update');
Route::delete('/domba/delete/{id}', [DombaController::class, 'destroy'])->name('domba.destroy');

Route::get('/kandang', [KandangController::class, 'index'])->name('kandang.index');
Route::get('/kandang/input', [KandangController::class, 'create'])->name('kandang.input');
Route::get('/kandang/{id}', [KandangController::class, 'show'])->name('kandang.show');
Route::post('/kandang/store', [KandangController::class, 'store'])->name('kandang.store');
Route::get('/kandang/edit/{id}', [KandangController::class, 'edit'])->name('kandang.edit');
Route::put('/kandang/update/{id}', [KandangController::class, 'update'])->name('kandang.update');
Route::delete('/kandang/delete/{id}', [KandangController::class, 'destroy'])->name('kandang.destroy');

Route::get('/breeding', [BreedingController::class, 'index'])->name('breeding.index');
Route::get('/breeding/input', [BreedingController::class, 'create'])->name('breeding.input');
Route::get('/breeding/inputSheep/{id}', [BreedingController::class, 'createSheep'])->name('breeding.inputSheep');
Route::get('/breeding/inputFeed/{id}', [BreedingController::class, 'createFeed'])->name('breeding.inputFeed');
Route::get('/breeding/{id}', [BreedingController::class, 'show'])->name('breeding.show');
Route::post('/breeding/store', [BreedingController::class, 'store'])->name('breeding.store');
Route::post('/breeding/storeSheep', [BreedingController::class, 'storeSheep'])->name('breeding.storeSheep');
Route::post('/breeding/storeFeed', [BreedingController::class, 'storeFeed'])->name('breeding.storeFeed');
Route::get('/breeding/edit/{id}', [BreedingController::class, 'edit'])->name('breeding.edit');
Route::put('/breeding/update/{id}', [BreedingController::class, 'update'])->name('breeding.update');
Route::delete('/breeding/delete/{id}', [BreedingController::class, 'destroy'])->name('breeding.destroy');

Route::get('/fattening', [FatteningController::class, 'index'])->name('fattening.index');
Route::get('/fattening/input', [FatteningController::class, 'create'])->name('fattening.input');
Route::get('/fattening/inputFeed/{id}', [FatteningController::class, 'createFeed'])->name('fattening.inputFeed');
Route::get('/fattening/{id}', [FatteningController::class, 'show'])->name('fattening.show');
Route::post('/fattening/store', [FatteningController::class, 'store'])->name('fattening.store');
Route::post('/fattening/storeFeed', [FatteningController::class, 'storeFeed'])->name('fattening.storeFeed');
Route::get('/fattening/edit/{id}', [FatteningController::class, 'edit'])->name('fattening.edit');
Route::put('/fattening/update/{id}', [FatteningController::class, 'update'])->name('fattening.update');
Route::delete('/fattening/delete/{id}', [FatteningController::class, 'destroy'])->name('fattening.destroy');

Route::get('/death', [DeathController::class, 'index'])->name('death.index');
Route::get('/death/input', [DeathController::class, 'create'])->name('death.input');
Route::get('/death/{id}', [DeathController::class, 'show'])->name('death.show');
Route::post('/death/store', [DeathController::class, 'store'])->name('death.store');
Route::get('/death/edit/{id}', [DeathController::class, 'edit'])->name('death.edit');
Route::put('/death/update/{id}', [DeathController::class, 'update'])->name('death.update');
Route::delete('/death/delete/{id}', [DeathController::class, 'destroy'])->name('death.destroy');