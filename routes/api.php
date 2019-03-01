<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('api.auth')->namespace('Api')->group(function() {

    //Products
    Route::get('/products', 'ProductController@index');
    Route::post('/products', 'ProductController@create');
    Route::get('/products/{id}', 'ProductController@show');
    Route::post('/products/{id}', 'ProductController@update');
    Route::post('/products/{id}/delete', 'ProductController@destroy');

    //Categories
    Route::get('/categories','CategoryController@index');
    Route::post('/categories','CategoryController@create');
    Route::get('/categories/{id}','CategoryController@show');
    Route::post('/categories/{id}', 'CategoryController@update');
    Route::post('/categories/{id}/delete','CategoryController@destroy');

    //Products by Category
    Route::get('/categories/{id}/products', 'Product_per_category@index');

});
