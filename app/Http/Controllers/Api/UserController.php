<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use Auth;
use App\Game;
use App\User;
use App\Role;

class UserController extends Controller
{
    public function getAllUsers(Request $request){
        $allUsers = User::all();
        return UserResource::collection($allUsers);
    }
    public function sendInvitation(Request $request) {
        $userId = $request->input('user_id');
        $gameId = $request->input('game_id');
        $game = Game::find($gameId);
        $game->users()->attach($userId);
        return response()->json('Invited successfully.');
    }
    public function acceptGame(Request $request) {
        $game_id = $request->input('game_id');
        $authenticatedUserId = Auth::id();
        $authenticatedUser = User::find($authenticatedUserId);
        $gameToAccept = $authenticatedUser->games()->find($game_id);
        if (!$gameToAccept)
           return response()->json('This Game is already accepted or not associated to this user.');
        $authenticatedUser->games()->updateExistingPivot($game_id, ['status'=>'Accepted']);
        return response()->json('Game accepted succefully.');
    }
    public function declineGame(Request $request) {
        $game_id = $request->input('game_id');
        $authenticatedUserId = Auth::id();
        $authenticatedUser = User::find($authenticatedUserId);
        $gameToDecline = $authenticatedUser->games()->find($game_id);
        if (!$gameToDecline)
           return response()->json('This Game is already declined or not associated to this user.');
        $authenticatedUser->games()->updateExistingPivot($game_id, ['status'=>'Declined']);
        return response()->json('You are about to decline the game.');
    }
    public function setUserRole(Request $request) {
        $user_id= $request->input('user_id');
        $game_id= $request->input('game_id');
        $user = User::find($userId);
        $user->games()->updateExistingPivot($game_id, ['role'=>'admin']);
        return response()->json('success');
    }
    public function revokePlayer(Request $request) {
        $user_id= $request->input('user_id');
        $game_id= $request->input('game_id');
        $user = User::find($user_id);
        $user->games()->detach($game_id);
        return response()->json('success');
    }
}
