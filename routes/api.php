<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FlowController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OutletController;
use App\Http\Controllers\Api\ContentController;
use App\Http\Controllers\Api\PhoneStateController;
use App\Http\Controllers\Api\OrderDetailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('outlets')->group(function () {
    Route::get("/", [OutletController::class, "index"]);
    Route::post("/create", [OutletController::class, "create"]);
    Route::put("/update/{id}", [OutletController::class, "update"]);
    Route::delete("/delete/{id}", [OutletController::class, "delete"]);
});

Route::prefix('flow')->group(function () {
    Route::get("/", [FlowController::class, "getFlow"]);
    Route::get("/all", [FlowController::class, "getFlows"]);
    Route::post("/create", [FlowController::class, "create"]);
});

Route::prefix('content')->group(function () {
    Route::get("/{id}", [ContentController::class, "findById"]);
    Route::post("/create", [ContentController::class, "create"]);
});

Route::prefix('state')->group(function () {
    Route::get("/", [PhoneStateController::class, "get"]);
    Route::post("/create", [PhoneStateController::class, "create"]);
    Route::delete("/delete/{phone}", [PhoneStateController::class, "delete"]);
});

Route::prefix('order')->group(function () {
    Route::post("/create", [OrderController::class, "create"]);
});

Route::prefix('order-detail')->group(function () {
    Route::post("/create", [OrderDetailController::class, "create"]);
});
