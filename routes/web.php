<?php

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::group(['middleware' => ['web']], function () {
    Route::middleware(['auth'])->group(function() {
        Route::get('/home', function () {
            return view('home');
        })->name('home');

        Route::get('change-password', 'ChangePasswordController@index')->name('change.password.index');
        Route::post('change-password', 'ChangePasswordController@store')->name('change.password');

        //administrator
        Route::namespace('UserMatrix')->prefix('usrmatrix')->name('usrmatrix.')->group(function () {
            Route::resource('role', 'RoleController')->except(['destroy'])->middleware('can:manage-role');
            Route::resource('user', 'UserRoleController')->except(['destroy'])->middleware('can:manage-user');

        });

         //question
        Route::namespace('Question')->prefix('question')->name('question.')->group(function () {
            Route::resource('number_1', 'Number1Controller')->except(['destroy'])->middleware('can:number-1');
            Route::resource('number_2', 'Number2Controller')->except(['destroy'])->middleware('can:number-2');
        });

        Route::post('/user', 'UserRoleController@index')->name('index');

    });
});
