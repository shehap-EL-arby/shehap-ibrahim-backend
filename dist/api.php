<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CoursesnewController;
use App\Http\Controllers\BooksnewController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::prefix('Student')->group(function () {
    Route::get("/" ,[StudentController::class,"index"]);
    Route::get("/{id}" ,[StudentController::class,"show"]);
    Route::put("/{id}" ,[StudentController::class,"update"]);
    Route::delete("/{id}" ,[StudentController::class,"destroy"]);
    Route::post("/" ,[StudentController::class,"store"]);
});
Route::prefix('coursesnew')->group(function () {
    Route::get("/" ,[CoursesnewController::class,"index"]);
    Route::get("/{id}" ,[CoursesnewController::class,"show"]);
    Route::put("/{id}" ,[CoursesnewController::class,"update"]);
    Route::delete("/{id}" ,[CoursesnewController::class,"destroy"]);
    Route::post("/" ,[CoursesnewController::class,"store"]);
});
Route::prefix('booksnews')->group(function () {
    Route::get("/" ,[BooksnewController::class,"index"]);
    Route::get("/{id}" ,[BooksnewController::class,"show"]);
    Route::put("/{id}" ,[BooksnewController::class,"update"]);
    Route::delete("/{id}" ,[BooksnewController::class,"destroy"]);
    Route::post("/" ,[BooksnewController::class,"store"]);
});