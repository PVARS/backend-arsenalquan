<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\admin\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix'=>'v1/admin'], function (){
    //Login route
    Route::post('login', [AuthController::class, 'auth']);

    $publicRoutes = function (){
        Route::group(['prefix'=>'user'], function (){
            /*
            |--------------------------------------------------------------------------
            | API User
            |--------------------------------------------------------------------------
            */
            Route::get('logout', [AuthController::class, 'logout']);
        });
    };

    Route::middleware(['middleware'=>'auth:sanctum'])->group($publicRoutes);
});


