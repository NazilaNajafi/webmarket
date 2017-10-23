<?php
Auth::routes();

Route::get('/', 'HomeController@index');
Route::group(['prefix' => 'admin','middleware' => 'admin'], function(){
    Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::match(['get', 'post'],'/editPassword', ['uses'=>'AdminController@editPassword'])->name('editPass');
    Route::match(['get', 'post'], '/offProduct', ['uses' => 'AdminController@offProduct'])->name('off');
    Route::get('/productList', 'AdminController@productList')->name('product_list');
    Route::match(['get', 'post'], '/addPhotos/{product}', ['uses' => 'AdminController@addPhotos'])->name('addPhotos');
    Route::get('/product', 'AdminController@newProduct')->name('new_product');
    Route::post('/save', 'AdminController@saveProduct')->name('save_product');
    Route::match(['get', 'post'], '/category', ['uses' => 'AdminController@newCategory'])->name('new_category');
    Route::get('/orders', 'AdminController@orders')->name('orders');
    Route::get('/delCat/{category}', 'AdminController@deleteCat')->name('delete_category');
    Route::get('/deleteComment/{comment}', 'AdminController@deleteComment')->name('delete_comment');
    Route::get('/comments', 'AdminController@comments')->name('comments');
    Route::get('/{id}', 'AdminController@checkComment')->name('check_comment');
    Route::get('/deleteProduct/{product}', 'AdminController@deleteProduct')->name('delete_product');
    Route::get('/updatePage/{product}', 'AdminController@updatePage')->name('update_page');
    Route::post('/updateProduct/{product}',  'AdminController@updateProduct')->name('update_product');





});


Route::get('/home/{id?}', 'HomeController@index')->name('home');
Route::get('exit', function (){
    return redirect()->route('home');
})->name('exit');
Route::get('/delAllCart', 'HomeController@delAllCart');
Route::get('/delCart/{id}/{rowId}', 'HomeController@deleteCart')->name('deleteCart');
Route::get('/detail/{product}', 'HomeController@detail')->name('detail');
Route::get('/subGroupList/{group?}/{id?}', 'HomeController@subGroupList')->name('subList');
Route::get('/search/{id?}', 'HomeController@search')->name('search');
Route::post('/addComment/{product}', 'HomeController@addComment')->name('addComment');
Route::post('/like', 'HomeController@like')->name('like');
Route::get('/aboutUs', 'HomeController@aboutUs')->name('aboutUs');
Route::match(['get', 'post'],'/contactUs',['uses'=> 'HomeController@contactUs'])->name('contactUs');
Route::get('/userPanel/{user}', 'HomeController@userPanel')->name('userPanel');
Route::get('/detail/{product}/{id?}', 'HomeController@detail')->name('detail');

Route::get('/test', 'HomeController@test');

Route::get('/checkoutStep1', 'HomeController@checkoutStep1')->name('checkoutStep1');
Route::get('/checkoutStep2', 'HomeController@checkoutStep2')->name('checkoutStep2')->middleware('auth');
Route::post('/checkoutStep2', 'HomeController@checkoutStep2')->name('create_buyer');
Route::get('/checkoutStep3/{id}' ,'HomeController@checkoutStep3')->name('checkoutStep3')->middleware('checkForm');
Route::get('/checkoutStep4', 'HomeController@checkoutStep4')->name('checkoutStep4')->middleware(['auth']);
Route::get('/payment', 'HomeController@payment')->name('payment');




