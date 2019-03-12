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

Route::middleware(['auth:api'])->group(function () {
    Route::get('accepted_games', 'Api\GameController@getAcceptedGames');
    Route::get('all_games', 'Api\GameController@getAllGames');
    Route::get('all_stadiums', 'Api\StadiumController@getAllStadiums');
    Route::post('stadium', 'Api\StadiumController@store');
    Route::post('game', 'Api\GameController@store');
    Route::get('game/{id}', 'Api\GameController@show');
    Route::delete('game/{id}', 'Api\GameController@destroy');
    Route::put('accept_game/{id}', 'Api\GameController@accept_game');
});
// Update a game.
//Route::put('game', 'Api\GameController@store');
















