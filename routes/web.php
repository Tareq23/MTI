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
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TechnologyController;


Route::get('/',[HomeController::class,'homeIndex']);
Route::get('/blog',[BlogController::class,'blogIndex'])->name('blogHome');
Route::get('/blog/post/{slug}',[BlogController::class,'singlePostView']);

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
    Route::get('/',[AdminController::class,'adminProfile']);
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

    /* Project */

    Route::get('/getAllProject',[ProjectController::class,'getAllProject']);
    Route::post('/projectConfirm',[ProjectController::class,'projectConfirm']);
    Route::post('/projectDelete',[ProjectController::class,'projectDelete']);

    /* TECHNOLOGY  */
    Route::get('/getAllTechnology',[TechnologyController::class,'getAllForAdmin']);
    Route::post('/addTechnology',[TechnologyController::class,'store']);
    Route::post('/deleteTechnology',[TechnologyController::class,'delete']);

    /* Notification */
    Route::get('/allNotification',[AdminController::class,'getNotification']);

    
    /* Posts */

    Route::get('/getAllPost',[PostController::class,'getAllPost']);
    Route::get('/getCategory',[CategoryController::class,'getCategory']);
    Route::post('/categoryPost',[PostController::class,'categoryPost']);
    Route::post('/postVerified',[PostController::class,'postVerified']);
    Route::post('/singlePostShow',[PostController::class,'singlePostShow']);
    Route::post('/deletePost',[PostController::class,'deletePost']);

    /* USER PROFILES */
    Route::get('/usersProfile',[ProfileController::class,'usersProfile']);
    Route::post('/profileDetails',[ProfileController::class,'profileDetails']);
    Route::post('/teamMemberConfirm',[ProfileController::class,'teamMemberConfirm']);
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


    /* Project Section */

    Route::post('/createProject',[ProjectController::class,'store']);
    Route::get('/userProjects',[ProjectController::class,'showUserProejct']);

    /* Category Controller */
    
    Route::get('/getCategory',[CategoryController::class,'getCategory']);

    /* Post  */

    Route::post('/createPost',[PostController::class,'create']);
    Route::get('/getUserPost',[PostController::class,'getUserPost']);


    /* Message */

    Route::get('/getAllUser',[MessageController::class,'getAllUser']);
    Route::post('/sentMessage',[MessageController::class,'store']);
    Route::get('/showMessages/{id}',[MessageController::class,'showMessages']);

});

Route::get('/{*}',function(){
    return view('not_found');
});

