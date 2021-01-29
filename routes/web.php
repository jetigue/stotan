<?php

use App\Http\Livewire\Training\Dashboard;
use App\Http\Livewire\Training\Macrocycles;
use App\Http\Livewire\Training\RunTypes;
use App\Http\Livewire\Training\ShowMacrocycle;
use App\Http\Livewire\Training\ShowMesocycle;
use App\Http\Livewire\Training\TrainingIntensities;
use App\Models\Training\Macrocycle;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/training/macrocycles', Macrocycles::class)->name('Macrocycles');
Route::get('/training', Dashboard::class)->name('Training Dashboard');
Route::get('training/run-types', RunTypes::class)->name('runTypes');
Route::get('training/intensities', TrainingIntensities::class)->name('trainingIntensities');
Route::get('training/macrocycles/{macrocycle}', ShowMacrocycle::class);
Route::get('training/macrocycles/{macrocycle}/mesocycles/{mesocycle}', ShowMesocycle::class);
