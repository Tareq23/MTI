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
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;


Route::get('/',[HomeController::class,'homeIndex']);
Route::get('/blog',[BlogController::class,'blogIndex'])->name('blogHome');

/* Mail Controller */
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
    'prefix'=>'/admin',
    'middleware' => 'adminAuth'
],function($route){
    Route::get('/',[AdminController::class,'userProfile']);
    Route::get('/getAllVerifiedUser',[AdminController::class,'getAllVerifiedUser']);
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

    /* Category */

    Route::post('/addCategory',[CategoryController::class,'addCategory']);
    Route::get('/showCategory',[CategoryController::class,'show']);
    Route::post('/checkCategory',[CategoryController::class,'check']);
    Route::post('/deleteCategory',[CategoryController::class,'delete']);
    Route::post('/updateCategory',[CategoryController::class,'update']);


    /* Tag */

    Route::post('/addTag',[TagController::class,'addTag']);
    Route::get('/showTag',[TagController::class,'showTag']);


});

Route::group([
    'prefix' => '/users',
    'middleware' => 'teamAuth'
],function($route){
    Route::get('/',[TeamMemberController::class,'index']);
    Route::get('/getProfile',[ProfileController::class,'getProfile']);
    Route::post('/nameUpdate',[ProfileController::class,'nameUpdate']);
    Route::post('/educationUpdate',[ProfileController::class,'educationUpdate']);
    Route::post('/imageUpdate',[ProfileController::class,'imageUpdate']);
    Route::post('/socialLinkUpdate',[ProfileController::class,'socialLinkUpdate']);
    Route::post('/descriptionUpdate',[ProfileController::class,'descriptionUpdate']);

    /* Category Controller */
    
    Route::get('/getCategory',[CategoryController::class,'getCategory']);

    /* Post  */

    Route::post('/createPost',[PostController::class,'create']);
    Route::get('/getUserPost',[PostController::class,'getUserPost']);

});

