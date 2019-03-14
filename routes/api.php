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
    Route::get('all_stadiums', 'Api\StadiumController@getAllStadiums');
    Route::post('stadium', 'Api\StadiumController@store');
    Route::get('accepted_games', 'Api\GameController@getAcceptedGames');
    Route::get('all_games', 'Api\GameController@getAllGames');
    Route::post('game', 'Api\GameController@store');
    Route::get('game', 'Api\GameController@show');
    Route::delete('game', 'Api\GameController@destroy');
    Route::post('accept_game', 'Api\UserController@acceptGame');
    Route::post('decline_game', 'Api\UserController@declineGame');
    Route::post('set_user_role', 'Api\UserController@setUserRole');
    Route::post('send_invitation', 'Api\UserController@sendInvitation');
    Route::get('show_comments', 'Api\CommentController@showCommentsInGame');
    Route::post('add_comment', 'Api\CommentController@store');
    Route::delete('delete_comment', 'Api\CommentController@destroy');
});
















