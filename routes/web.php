<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;




Route::get('/',[HomeController::class,'homeIndex']);
Route::get('/blog',[BlogController::class,'blogIndex'])->name('blogHome');
Route::get('/blog/{token}',[MailController::class,'confirmEmail']);



/*
|   USER REGISTRATION
*/

Route::post('/checkEmail',[UserController::class,'checkEmail']);
Route::post('/register',[UserController::class,'register']);

