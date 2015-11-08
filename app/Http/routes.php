<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'FrontController@index');
//page route for admin
Route::get('home', ['as'=>'mainAdmin', 'uses'=>'HomeController@index']);
Route::get('home/add-new-user', ['as'=>'addUser', 'uses'=>'HomeController@newUser']);
Route::get('home/add-product', ['as'=>'addProduct', 'uses'=>'HomeController@newProduct']);
Route::get('home/product-list', ['as'=>'productList', 'uses'=>'HomeController@productList']);
Route::get('home/product-edit/{id}', ['as'=>'productEdit', 'uses'=>'HomeController@productEdit']);
Route::get('home/categories', ['as'=>'catList', 'uses'=>'HomeController@catList']);

//service routs for Admin
Route::post('home/post-product', ['as'=>'postProduct', 'uses'=>'HomeController@postProduct']);
Route::post('home/post-product-edit', ['as'=>'postProductEdit', 'uses'=>'HomeController@postProductEdit']);
Route::get('home/delete-product', ['as'=>'deleteProduct', 'uses'=>'HomeController@deleteProduct']);
Route::post('home/ajax-image', ['as'=>'ajaxImage', 'uses'=>'HomeController@ajaxImage']);
Route::get('home/cat-edit', ['as'=>'catEdit', 'uses'=>'HomeController@catEdit']);
Route::get('home/cat-edit-change', ['as'=>'catApplyChange', 'uses'=>'HomeController@catApplyChange']);
Route::get('home/cat-new', ['as'=>'catNew', 'uses'=>'HomeController@catNew']);
Route::get('home/delete-category', ['as'=>'deleteCategory', 'uses'=>'HomeController@deleteCategory']);

//pages for users
Route::get('product/{id}', ['as'=>'singleProduct', 'uses'=>'FrontController@product'])->where('id', '\d+');
Route::get('category/{name}', ['as' => 'category', 'uses' => 'FrontController@category'])->where('name', '[a-z_-]+');
Route::get('/addtocart/{id}/{number?}', ['as' => 'addToCart', 'uses'=>'CartController@addToCart']);
Route::get('/showcart', ['as' => 'showCart', 'uses'=>'CartController@getCartAjax']);
Route::get('/updatecart', ['as' => 'updateCart', 'uses'=>'CartController@appendItem']);
Route::get('/cart/order', ['as' => 'makeOrder', 'uses' =>'CartController@order']);
Route::post('/cart/change', ['as'=>'changeAmount', 'uses'=>'CartController@changeAmount']);
Route::get('/cart/delete', ['as'=>'deleteItem', 'uses'=>'CartController@deleteItem']);
Route::post('/cart/applyorder', ['as'=>'applyOrder', 'uses'=>'CartController@apply']);
Route::get('/{targetPage}', ['as' => 'statics', 'uses' => 'FrontController@stat'])->where('targetPage', '[a-z_-]+');



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
