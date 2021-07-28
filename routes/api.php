<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\admin\AuthController;
use App\Http\Controllers\api\admin\RoleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix'=>'v1/admin'], function (){
    //Login route
    Route::post('login', [AuthController::class, 'auth']);

    $publicRoutes = function (){
        /*
        |--------------------------------------------------------------------------
        | API User
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix'=>'user'], function (){
            Route::get('logout', [AuthController::class, 'logout']);
        });

        /*
        |--------------------------------------------------------------------------
        | API Role
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix'=>'role'], function (){
            Route::get('/', [RoleController::class, 'findAll']);
            Route::get('/{role}', [RoleController::class, 'getById']);
            Route::post('/', [RoleController::class, 'store']);
            Route::put('/{role}', [RoleController::class, 'update']);
            Route::delete('/{role}', [RoleController::class, 'destroy']);
            Route::get('/disable/{role}', [RoleController::class, 'disable']);
        });
    };

    Route::middleware(['middleware'=>'auth:sanctum'])->group($publicRoutes);
});


