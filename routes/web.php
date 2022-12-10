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


   // Test
    Route::namespace('Test')->prefix('test')->group(function(){

        Route::get('/', 'IndexController@index');
        Route::get('/pdf', 'IndexController@pdf');
        Route::get('/ldap', 'IndexController@ldap');
        Route::get('/oracle', 'IndexController@oracle');
        Route::get('/phpinfo', 'IndexController@phpinfo');
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
