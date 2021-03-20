<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TeamMemberController;


Route::get('/',[HomeController::class,'homeIndex']);
Route::get('/blog',[BlogController::class,'blogIndex'])->name('blogHome');
Route::get('/blog/{token}',[MailController::class,'confirmEmail']);

/* Contact Message */

Route::post('/contacts',[ContactController::class,'store']);

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
    /* Roles Route */
    Route::get('/roles',[RoleController::class,'indexRole']);
    Route::get('/allRoles',[RoleController::class,'allRole']);
    Route::post('/add/role',[RoleController::class,'addRole']);
    Route::post('/getRole',[RoleController::class,'getRole']);
    Route::post('/setRole',[RoleController::class,'setRole']);
    /* Contact message Route */
    Route::get('/getContactAll',[ContactController::class,'getContactAll']);
    Route::get('/getMessage/{id}',[ContactController::class,'getMessage']);
    Route::post('/contactDelete',[ContactController::class,'contactDelete']);

    /* IMAGE GALLERY */

    Route::post('/uploadImageFile',[GalleryController::class,'uploadImageFile']);
    Route::get('/getTopEightImageUlr',[GalleryController::class,'getTopEightImageUlr']);
    Route::post('/loadMoreGalleryImage',[GalleryController::class,'loadMoreGalleryImage']);
});

Route::group([
    'prefix' => '/users'
],function($route){
    Route::get('/',[TeamMemberController::class,'index']);
});

