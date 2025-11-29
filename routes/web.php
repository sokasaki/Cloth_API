<?php
// At the top of routes/web.php
// require __DIR__.'/api.php';

use Illuminate\Support\Facades\Route;


// Route::prefix('api')->group(function () {
//     require __DIR__.'/api.php';
// });


Route::get('/', function () {
    return response()->json(['message' => 'Welcome to the Clothes API']);
});