<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Emails;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//session_start();

Route::get('/', 'pagesController@home');

Route::get('/gallery', 'pagesController@gallery');

Route::get('/about', 'pagesController@about')->name("about");

Route::get('/contact-us', 'pagesController@contact')->name("contact");

Route::post('/validate_form', 'pagesController@validForm');

// admin space


// start login ---------------------------------------------
Route::get('/admin/login', 'pagesController@get_login');

Route::post('/admin/verify_login/', 'pagesController@login');
// end login -----------------------------------

// start logout --------------------------------
Route::get('/admin/logout', 'pagesController@logout')->name('logout');
// end logout ----------------------------------

// start home page: ----------------------------
Route::get('/admin', 'pagesController@dashboard')->name("dashbaord");
// end home page -------------------------------

// start gallery page: ----------------------------
Route::resource('/admin/gallery', 'galleryController');
// end gallery page -----------------------------

// start profile page: --------------------------
Route::resource('/admin/profile', 'profileController');
// end profile page ------------------------------

// start messages page ---------------------------
Route::resource('/admin/messages', 'emailsController');

Route::resource('/admin/send_mail', 'emailsController');
// end messages page ---------------------------

// start about page:
Route::resource('/admin/about', 'aboutController');
// end about page.



// ---- start testing

use App\Users;
use App\Posts;

Route::get('/admin/posts_of_user_relation/{id}', function($id) {

    return Users::find($id)->posts;
});

Route::get('/admin/user_of_post_relation/{id}', function($id) {

    return Posts::find($id)->users;
});
// end testing
