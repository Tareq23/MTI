<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;





Route::get('/',[HomeController::class,'homeIndex']);
Route::get('/blog',[BlogController::class,'blogIndex'])->name('blogHome');
