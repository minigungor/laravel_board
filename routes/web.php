<?php


Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/verify/{token}', 'Auth\RegisterController@verify')->name('register.verify');

Route::get('/cabinet', 'HomeController@index')->name('cabinet');

//Route::prefix('admin')->group(function () {
//    Route::middleware('auth')->group(function () {
//        Route::namespace('Admin')->group(function () {
//            Route::get('/', 'HomeController@index')->name('admin.home');
//            Route::resource('users', 'UsersController');
//        });
//    });
//});

Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'as' => 'admin.',
        'middleware' => ['auth']
    ],
    function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::resource('users', 'UsersController');
    }
);


//
//Route::get('/register', 'Auth\OwnRegisterController@form')->name('register');
//Route::post('/register', 'Auth\OwnRegisterController@register');

