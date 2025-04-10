<?php

use App\Http\Controllers\Co2Controller;
use App\Http\Controllers\PercentagesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SourcesController;
use App\Http\Controllers\TotalConsumptionController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Util\Percentage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Sources routes
Route::get('/', [SourcesController::class, 'index'])->name('source.index');
Route::post('/Sources', [SourcesController::class, 'store'])->name('source.store');
Route::get('/Sources/{id}/edit', [SourcesController::class, 'edit'])->name('source.edit');
Route::post('/Sources/{id}', [SourcesController::class, 'update'])->name('source.update');
Route::delete('/Sources/{id}', [SourcesController::class, 'destroy'])->name('source.destroy');

//Products routes
Route::get('/Products', [ProductsController::class, 'index'])->name('product.index');
Route::post('/Products', [ProductsController::class, 'store'])->name('product.store');
Route::get('/Products/{id}/edit', [ProductsController::class, 'edit'])->name('product.edit');
Route::post('/Products/{id}', [ProductsController::class, 'update'])->name('product.update');
Route::delete('/Products/{id}', [ProductsController::class, 'destroy'])->name('product.destroy');


// Percentages routes
Route::get('/Percentages', [PercentagesController::class, 'index'])->name('percentage.index');
Route::post('/Percentages', [PercentagesController::class, 'store'])->name('percentage.store');
Route::get('/Percentages/{id}/edit', [PercentagesController::class, 'edit'])->name('percentage.edit');
Route::post('/Percentages/{id}', [PercentagesController::class, 'update'])->name('percentage.update');
Route::delete('/Percentages/{id}', [PercentagesController::class, 'destroy'])->name('percentage.destroy');



//Co2 routes
Route::get('/Co2', [Co2Controller::class, 'index'])->name('co2.index');
Route::post('/Co2', [Co2Controller::class, 'store'])->name('co2.store');
Route::get('/Co2/{id}/edit', [Co2Controller::class, 'edit'])->name('co2.edit');
Route::post('/Co2/{id}', [Co2Controller::class, 'update'])->name('co2.update');
Route::delete('/Co2/{id}', [Co2Controller::class, 'destroy'])->name('co2.destroy');


// TotaConsumption routes
Route::get('/TotalConsumption', [TotalConsumptionController::class, 'index'])->name('totalConsumption.index');
Route::post('/TotalConsumption', [TotalConsumptionController::class, 'store'])->name('totalConsumption.store');
Route::get('/TotalConsumption/{id}/edit', [TotalConsumptionController::class, 'edit'])->name('totalConsumption.edit');
Route::post('/TotalConsumption/{id}', [TotalConsumptionController::class, 'update'])->name('totalConsumption.update');
Route::delete('/TotalConsumption/{id}', [TotalConsumptionController::class, 'destroy'])->name('totalConsumption.destroy');