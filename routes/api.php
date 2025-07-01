<?php

use App\Http\Controllers\CoverArtController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return 'Hello World';
// });

Route::apiResource('cover-art', CoverArtController::class);