<?php

use App\Http\Controllers\PayPalController;
use App\Http\Controllers\TechnicalCollege\JapanLanguageController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::get('donate', fn() => Inertia::render('DonationPage'))->name('donate');
Route::post("checkout-paypal", [PayPalController::class, "createPayment"]);
Route::post("execute-paypal", [PayPalController::class, "executePaypal"]);

Route::group(["prefix" => "technical-college"], function () {
    Route::get('japanese-training-form', [JapanLanguageController::class, "showRegistrationForm"]);
    Route::post('japanese-training-form', [JapanLanguageController::class, "saveApplication"])->name('tc.japanese.form');
});
