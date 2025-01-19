<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\NameImageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Route::group(['middleware' => 'cors'], function () {
Route::get('/images', [NameImageController::class, 'index']);
Route::post('/name-images', [NameImageController::class, 'store']);
Route::delete('/name-images/{id}', [NameImageController::class, 'destroy']);

// });






Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
