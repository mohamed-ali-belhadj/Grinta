<?php
use Illuminate\Http\Request;

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
Route::group([
    'middleware'=>'auth:api'
], function() {
    Route::get('/logout', 'Api\AuthController@logout');
    Route::get('/user', 'Api\AuthController@user');
});

Route::group([
    'middleware'=>'api'
], function() {
    Route::post('password/create', 'Api\PasswordResetController@create');
    Route::get('password/find/{token}', 'Api\PasswordResetController@find');
    Route::post('password/reset', 'Api\PasswordResetController@reset');
});














