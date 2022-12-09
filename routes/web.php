<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('Project.User.index');
// });

Route::namespace('App\Http\Controllers')->group(function(){


    // Auth 
    Route::namespace('Auth')->group(function(){

        // Route::get('/login', 'IndexController@login')->name('login');
        Route::post('/login_action', 'LoginController@login_action');
        Route::get('/logout', 'LoginController@logout');

        Route::post('/register_check', 'RegisterController@check');
        Route::post('/register_store', 'RegisterController@store');

        Route::get('/test', 'Common\Log@test'); 
        Route::get('login/{any?}', 'IndexController@index')->name('login');
        Route::get('register/{any?}', 'IndexController@index')->name('register');
        // user-manuals
        Route::get('/user-manuals', 'IndexController@userManuals');
        // auth_check
        Route::get('/auth_check', 'IndexController@auth_check');

    });


    Route::namespace('Admin')->prefix('admin')->group(function(){

        Route::get('/', 'IndexController@index');


        Route::get('{any?}', 'IndexController@index');
    });

    Route::namespace('User')->group(function(){

        Route::get('/', 'IndexController@index');

        Route::namespace('Crud')->prefix('store')->group(function(){
            Route::get('/index', 'IndexController@index');
            Route::post('/store', 'IndexController@store');
        });



        Route::get('{any?}', 'IndexController@index');
    });

    
});
