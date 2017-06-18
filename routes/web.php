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
/*
Route::get('/', function () {
    return view('welcome');
});
*/


Route::get('/', "User\UsersController@index");
Route::get('/sign-up.html', "Auth\RegisterController@signUp");
//Route::get('/sign-in.html','User\UsersController@index');

//User related Routes
Route::group(['prefix' => 'secure'],function(){
    Route::get('/dashboard.html','Home\HomeController@index');

    Route::get('/items.html','Item\ItemsController@index');
    Route::get('/add-items.html','Item\ItemsController@addItem');
    //Route::post('/saveItem','Item\ItemsController@saveItem');

    Route::get('/view-item.html/{id}','Item\ItemsController@viewItem');

    Route::get('/categories.html','Category\CategoriesController@index');
    Route::get('/add-categories.html','Category\CategoriesController@addCategory');
    //Route::post('/saveCategory','Category\CategoriesController@saveCategory');

    Route::get('/add-users.html','Auth\RegisterController@addUser');

    Route::get('/suppliers.html','Supplier\SuppliersController@index');
    Route::get('/add-suppliers.html','Supplier\SuppliersController@addSupplier');

    Route::get('/customers.html','Customer\CustomersController@index');
    Route::get('/add-customers.html','Customer\CustomersController@addCustomer');
});

//User related Routes
Route::group(['prefix' => 'user'],function(){
    Route::get('/add.html','User\UsersController@index');
    Route::get('/view.html/{id}','User\UsersController@view');
});

//Item related Routes
Route::group(['prefix' => 'item'],function(){
    Route::get('/add.html','Item\ItemsController@index');
    //Route::get('/view.html/{id}','Item\ItemsController@view');
});