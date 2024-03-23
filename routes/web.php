<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuitController;
use App\Http\Controllers\TypeController;
use Illuminate\Http\Request;
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
    return redirect()->route('login');
});
Route::get('/login', function () { return view('login'); })->name('login');
Route::post('/login', [AuthController::class, "login"])->name('login.post');



Route::middleware(["auth:sanctum"])->group(function () {
    Route::get('/suits', [SuitController::class, "index"])->name("suits");
    Route::get('/types', [TypeController::class, "index"])->name("types");
    Route::post('/types', [TypeController::class, "store"])->name("types.store");
    

    Route::get('/suits/edit', function () {
        return view('suits.edit');
    })->name("suits.edit");

    Route::post('/suits', [SuitController::class, "store"])->name("suits.store");

    Route::post('/suits/{suit}', [SuitController::class, "updateSuit"])->name("suits.update");

    Route::delete('/suits/{suit}', [SuitController::class, "delete"])->name("suits.delete");

    // Route::apiResource('types', TypeController::class);
});