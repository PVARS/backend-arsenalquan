<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\admin\AuthController;
use App\Http\Controllers\api\admin\RoleController;
use App\Http\Controllers\api\admin\UserController;

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

        /*
        |--------------------------------------------------------------------------
        | API User
        |--------------------------------------------------------------------------
        */
        Route::group(['prefix'=>'user'], function (){
            Route::get('logout', [AuthController::class, 'logout']);
            Route::get('/', [UserController::class, 'findAll']);
            Route::get('/{user}', [UserController::class, 'getById']);
            Route::post('/', [UserController::class, 'register']);
            Route::put('/{user}', [UserController::class, 'update']);
            Route::get('/disable/{user}', [UserController::class, 'disable']);
        });
    };

    Route::middleware(['middleware'=>'auth:sanctum'])->group($publicRoutes);
});


