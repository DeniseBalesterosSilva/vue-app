<?php

use App\Http\Controllers\AssetsListController;
use App\Http\Controllers\ChunkController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\ConsolidatedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/chunk/{id}', [ChunkController::class, 'index'])->name('chunk');
Route::post('chunk-store', [ChunkController::class, 'store'])->name('chunk-store');


Route::get('consolidated', [ConsolidatedController::class, 'index'])->name('consolidated');

Route::get('dash', [DashController::class, 'index'])->name('dash');

Route::get('assets-list', [AssetsListController::class, 'index'])->name('assets-list');

Route::get('compare', [CompareController::class, 'index'])->name('compare');
Route::post('compare', [CompareController::class, 'index'])->name('compare');

// Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');




// });