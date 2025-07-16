<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DombaController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\BreedingController;
use App\Http\Controllers\FatteningController;
use App\Http\Controllers\DeathController;
use App\Http\Controllers\PanCategoryController;
use App\Http\Controllers\ConsentrateCategoryController;
use App\Http\Controllers\ChildCategoryController;
use App\Http\Controllers\TransferController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'index']);


Route::get('/domba', [DombaController::class, 'index'])->name('domba.index');
Route::get('/domba/input', [DombaController::class, 'create'])->name('domba.input');
Route::get('/domba/inputPhase/{id}', [DombaController::class, 'createPhase'])->name('domba.inputPhase');
Route::get('/domba/inputWeight/{id}', [DombaController::class, 'createWeight'])->name('domba.inputWeight');
Route::get('/domba/inputDisease/{id}', [DombaController::class, 'createDisease'])->name('domba.inputDisease');
Route::get('/domba/inputPregnant/{id}', [DombaController::class, 'createPregnant'])->name('domba.inputPregnant');
Route::get('/domba/inputTransfer/{id}', [DombaController::class, 'createTransfer'])->name('domba.inputTransfer');
Route::get('/domba/{id}', [DombaController::class, 'show'])->name('domba.show');
Route::post('/domba/store', [DombaController::class, 'store'])->name('domba.store');
Route::post('/domba/storeWeight', [DombaController::class, 'storeWeight'])->name('domba.storeWeight');
Route::post('/domba/storeDisease', [DombaController::class, 'storeDisease'])->name('domba.storeDisease');
Route::post('/domba/storePhase', [DombaController::class, 'storePhase'])->name('domba.storePhase');
Route::post('/domba/storePregnant', [DombaController::class, 'storePregnant'])->name('domba.storePregnant');
Route::get('/domba/edit/{id}', [DombaController::class, 'edit'])->name('domba.edit');
Route::put('/domba/update/{id}', [DombaController::class, 'update'])->name('domba.update');
Route::delete('/domba/delete/{id}', [DombaController::class, 'destroy'])->name('domba.destroy');


Route::get('/kandang', [KandangController::class, 'index'])->name('kandang.index');
Route::get('/kandang/input', [KandangController::class, 'create'])->name('kandang.input');
Route::get('/kandang/inputPan/{id}', [KandangController::class, 'createPan'])->name('kandang.inputPan');
Route::get('/kandang/{id}', [KandangController::class, 'show'])->name('kandang.show');
Route::post('/kandang/store', [KandangController::class, 'store'])->name('kandang.store');
Route::post('/kandang/storePan', [KandangController::class, 'storePan'])->name('kandang.storePan');
Route::get('/kandang/edit/{id}', [KandangController::class, 'edit'])->name('kandang.edit');
Route::put('/kandang/update/{id}', [KandangController::class, 'update'])->name('kandang.update');
Route::delete('/kandang/delete/{id}', [KandangController::class, 'destroy'])->name('kandang.destroy');


Route::get('/breeding', [BreedingController::class, 'index'])->name('breeding.index');
Route::get('/breeding/input', [BreedingController::class, 'create'])->name('breeding.input');
Route::get('/breeding/inputSheep/{id}', [BreedingController::class, 'createSheep'])->name('breeding.inputSheep');
Route::get('/breeding/inputFeed/{id}', [BreedingController::class, 'createFeed'])->name('breeding.inputFeed');
Route::get('/breeding/{id}', [BreedingController::class, 'show'])->name('breeding.show');
Route::get('/breeding/showPan/{id}', [BreedingController::class, 'showPan'])->name('breeding.showPan');
Route::get('/breeding/transferSheep/{idBreedingSheep}/{idBreeding}', [BreedingController::class, 'transferSheep'])->name('breeding.transferSheep');
Route::post('/breeding/store', [BreedingController::class, 'store'])->name('breeding.store');
Route::post('/breeding/storeSheep', [BreedingController::class, 'storeSheep'])->name('breeding.storeSheep');
Route::post('/breeding/storeFeed', [BreedingController::class, 'storeFeed'])->name('breeding.storeFeed');
Route::get('/breeding/edit/{id}', [BreedingController::class, 'edit'])->name('breeding.edit');
Route::put('/breeding/update/{id}', [BreedingController::class, 'update'])->name('breeding.update');
Route::put('/breeding/updateTransferSheep/{id}', [BreedingController::class, 'updateTransferSheep'])->name('breeding.updateTransferSheep');
Route::delete('/breeding/delete/{id}', [BreedingController::class, 'destroy'])->name('breeding.destroy');


Route::get('/fattening', [FatteningController::class, 'index'])->name('fattening.index');
Route::get('/fattening/input', [FatteningController::class, 'create'])->name('fattening.input');
Route::get('/fattening/inputSheep/{id}', [FatteningController::class, 'createSheep'])->name('fattening.inputSheep');
Route::get('/fattening/inputFeed/{id}', [FatteningController::class, 'createFeed'])->name('fattening.inputFeed');
Route::get('/fattening/{id}', [FatteningController::class, 'show'])->name('fattening.show');
Route::get('/fattening/showPan/{id}', [FatteningController::class, 'showPan'])->name('fattening.showPan');
Route::post('/fattening/store', [FatteningController::class, 'store'])->name('fattening.store');
Route::post('/fattening/storeSheep', [FatteningController::class, 'storeSheep'])->name('fattening.storeSheep');
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


Route::get('/pan_category', [PanCategoryController::class, 'index'])->name('pan_category.index');
Route::get('/pan_category/input', [PanCategoryController::class, 'create'])->name('pan_category.input');
Route::get('/pan_category/{id}', [PanCategoryController::class, 'show'])->name('pan_category.show');
Route::post('/pan_category/store', [PanCategoryController::class, 'store'])->name('pan_category.store');
Route::get('/pan_category/edit/{id}', [PanCategoryController::class, 'edit'])->name('pan_category.edit');
Route::put('/pan_category/update/{id}', [PanCategoryController::class, 'update'])->name('pan_category.update');
Route::delete('/pan_category/delete/{id}', [PanCategoryController::class, 'destroy'])->name('pan_category.destroy');


Route::get('/consentrate_category', [ConsentrateCategoryController::class, 'index'])->name('consentrate_category.index');
Route::get('/consentrate_category/input', [ConsentrateCategoryController::class, 'create'])->name('consentrate_category.input');
Route::get('/consentrate_category/{id}', [ConsentrateCategoryController::class, 'show'])->name('consentrate_category.show');
Route::post('/consentrate_category/store', [ConsentrateCategoryController::class, 'store'])->name('consentrate_category.store');
Route::get('/consentrate_category/edit/{id}', [ConsentrateCategoryController::class, 'edit'])->name('consentrate_category.edit');
Route::put('/consentrate_category/update/{id}', [ConsentrateCategoryController::class, 'update'])->name('consentrate_category.update');
Route::delete('/consentrate_category/delete/{id}', [ConsentrateCategoryController::class, 'destroy'])->name('consentrate_category.destroy');


Route::get('/child_category', [ChildCategoryController::class, 'index'])->name('child_category.index');
Route::get('/child_category/input', [ChildCategoryController::class, 'create'])->name('child_category.input');
Route::get('/child_category/{id}', [ChildCategoryController::class, 'show'])->name('child_category.show');
Route::post('/child_category/store', [ChildCategoryController::class, 'store'])->name('child_category.store');
Route::get('/child_category/edit/{id}', [ChildCategoryController::class, 'edit'])->name('child_category.edit');
Route::put('/child_category/update/{id}', [ChildCategoryController::class, 'update'])->name('child_category.update');
Route::delete('/child_category/delete/{id}', [ChildCategoryController::class, 'destroy'])->name('child_category.destroy');

Route::get('/get-phase-options', [TransferController::class, 'getPhaseOptions']);
