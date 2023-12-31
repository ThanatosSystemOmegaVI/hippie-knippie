<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\DienstenController;
use App\Http\Controllers\ContactverzoekenController;
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
// ============ GET ============

// user
Route::get('/', function () {
    return view('welcome');
});

// diensten
// Route::get('/getimagedata/{type}/{name}', [ShipsController::class, 'getImage']);

// ============ POST ============

// Users
Route::post('/loginuser', [UsersController::class, 'getUser']);
Route::post('/checkuser', [UsersController::class, 'checkUser']);

// Diensten
Route::post('/getdiensten', [DienstenController::class, 'getDiensten']);
Route::post('/adddienst', [DienstenController::class, 'addDienst']);
Route::post('/editdienst', [DienstenController::class, 'editDienst']);
Route::post('/deletedienst', [DienstenController::class, 'deleteDienst']);

// Contact verzoeken
Route::post('/getcontactverzoeken', [ContactverzoekenController::class, 'getContactVerzoeken']);
Route::post('/addcontactverzoek', [ContactverzoekenController::class, 'addContactVerzoek']);

// ============ DEFAULT ============
Route::get('{any?}', function ($any = null) {
    return view('welcome');
})->where('any', '.*');
