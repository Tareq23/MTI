<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;


Route::get('/',[HomeController::class,'homeIndex']);
Route::get('/blog',[BlogController::class,'blogIndex'])->name('blogHome');
Route::get('/blog/{token}',[MailController::class,'confirmEmail']);



/*
|   USER REGISTRATION
*/

Route::post('/checkEmail',[UserController::class,'checkEmail']);
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::get('/logout',[UserController::class,'logout']);

Route::group([
    'prefix'=>'/admin'
],function($route){
    Route::get('/',[AdminController::class,'userProfile']);
    Route::get('/getAllVerifiedUser',[UserController::class,'getAllVerifiedUser']);
    Route::get('/roles',[RoleController::class,'indexRole']);
    Route::get('/allRoles',[RoleController::class,'allRole']);
    Route::post('/add/role',[RoleController::class,'addRole']);
    Route::post('/getRole',[RoleController::class,'getRole']);
    Route::post('/setRole',[RoleController::class,'setRole']);
});