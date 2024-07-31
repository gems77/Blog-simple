<?php

use App\Http\Controllers\BlogController;
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

Route::GET("/", [BlogController::class, "getInfos"]);

Route::prefix('post')->group(function () {
    Route::POST("create", [BlogController::class, "addPost"])->name('addPost');
    Route::PUT("update/{id}", [BlogController::class, "updatePost"])->name('updatePost');
    Route::DELETE("delete/{id}", [BlogController::class, "deletePost"])->name('deletePost');
    Route::GET("/welcomeDetail/{id}", [BlogController::class, "getPostDetail"]);

});

Route::prefix('comment')->group(function () {
    Route::POST("create", [BlogController::class, "addComment"])->name('addComment');
    Route::PUT("update/{id}", [BlogController::class, "updateComment"])->name('updateComment');
    Route::DELETE("delete/{id}", [BlogController::class, "deleteComment"])->name('deleteComment');
});
