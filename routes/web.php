<?php

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


Route::get('/get/images/{file}', function ($file) {
    $path = storage_path('app/public/images/' . $file);
    
    if (!file_exists($path)) {
        abort(404);
    }

    $headers = [
        'Access-Control-Allow-Origin' => 'http://localhost:8081',  // The frontend domain
        'Content-Type' => mime_content_type($path),
    ];

    return response()->file($path, $headers);
});

