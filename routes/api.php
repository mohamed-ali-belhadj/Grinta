<?php
use Illuminate\Http\Request;

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
Route::post('password/create', 'Api\PasswordResetController@create');
Route::get('password/find/{token}', 'Api\PasswordResetController@find');
Route::post('password/reset', 'Api\PasswordResetController@reset');

Route::middleware(['auth:api'])->group(function () {
    // Auth Routes
    Route::get('/logout', 'Api\AuthController@logout');
    Route::get('/user', 'Api\AuthController@user');
    // Stadium Routes
    Route::get('all_stadiums', 'Api\StadiumController@getAllStadiums');
    Route::post('stadium', 'Api\StadiumController@store');
    // Game Routes
    Route::get('accepted_games', 'Api\GameController@getAcceptedGames');
    Route::get('all_games', 'Api\GameController@getAllGames');
    Route::post('game', 'Api\GameController@store');
    Route::get('game', 'Api\GameController@show');// Check user === member in that game.
    Route::delete('game', 'Api\GameController@destroy'); // ACL Admin.
    Route::get('players_list_per_game', 'Api\GameController@getPlayersList'); // Check user === member in that game.
    Route::get('admins_list_per_game', 'Api\GameController@getAdminsList');
    // User Routes
    Route::post('accept_game', 'Api\UserController@acceptGame');
    Route::post('decline_game', 'Api\UserController@declineGame');
    Route::post('set_user_role', 'Api\UserController@setUserRole'); // ACL Admin.
    Route::post('send_invitation', 'Api\UserController@sendInvitation');
    Route::post('revoke_player_in_game', 'Api\UserController@revokePlayer'); // ACL Admin.
    // Comment Routes
    Route::get('show_comments', 'Api\CommentController@showCommentsInGame');// Check user === member in that game.
    Route::post('add_comment', 'Api\CommentController@store'); // Check user === member in that game.
    Route::delete('delete_comment', 'Api\CommentController@destroy'); // Check user === owner comment.
});
















