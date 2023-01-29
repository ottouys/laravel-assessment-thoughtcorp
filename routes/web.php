<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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

Route::get('/results', [PageController::class, 'results']);
Route::get('/trip-summary', [PageController::class, 'tripSummary']);
Route::get('/passenger-details', [PageController::class, 'passengerDetails']);
Route::post('/passenger-details', [PageController::class, 'storePassengerDetails'])->name('passenger-details.submit');
Route::get('/form-success', [PageController::class, 'thankyou'])->name('form.success');
