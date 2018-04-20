<?php

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

Auth::routes();

Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});

Route::get('/', 'HomeController@index');
Route::get('/subcategory', 'HomeController@showSubcategories');
Route::get('/words_list', 'HomeController@showWordsLists');
Route::get('/learning_mode', 'HomeController@showLearningModes');
Route::get('/mode', 'HomeController@showModes');
Route::get('/learn', 'HomeController@learnWords');
Route::get('/store_results', 'HomeController@storeResults');
Route::post('/store_results', 'HomeController@storeResults');
Route::post('cos/{id}', function ($id) {
    return 'User '.$id;
});
Route::get('cos/{id}', function ($id) {
    return 'Usersada '.$id;
});

Route::resource('users', 'UserController', ['except' => ['show']])->middleware('role:admin');
Route::get('users/{id}', 'UserController@show');
Route::resource('categories', 'CategoryController')->middleware('role:admin');
Route::resource('subcategories', 'SubcategoryController')->middleware('role:admin');
Route::resource('words', 'WordController')->middleware('role:redaktor,super_redaktor,admin');

Route::group(['middleware' => ['role:redaktor,super_redaktor,admin']], function() {

    // Need permission to do this actions in "except"
    Route::resource('words_lists', 'WordsListController', [
        'except' => ['show','edit','update','destroy']
    ]);

    Route::group(['middleware' => ['permission']], function() {
        Route::resource('words_lists', 'WordsListController', [
            'except' => ['index','create','store']
        ]);
    });
});

