<?php

use App\Http\Livewire\Training\Planner;
use App\Http\Livewire\Training\ShowMacrocycle;
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

Route::get('/training/planner', Planner::class);
Route::get('training/macrocycles/{macrocycle}', ShowMacrocycle::class);
