<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuhtController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BranchController;

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
 
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuhtController::class, 'register']);
Route::post('login', [AuhtController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuhtController::class, 'logout']);

Route::apiResource('users', UsersController::class);
Route::apiResource('brands', BrandController::class);
Route::apiResource('branches', BranchController::class);

Route::get('getBranchCountsByRegion/{regionId}', [MainController::class, 'getBranchCountsByRegion']);
Route::get('regions', [MainController::class, "regionsList"]);
Route::get('districts', [MainController::class, "districtsList"]);
Route::get('currencies', [MainController::class, "currencies"]);



