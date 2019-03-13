<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Game;
use App\User;
use App\Role;

class UserController extends Controller
{
    public function acceptGame($id) {
        $authenticatedUserId = Auth::id();
        $authenticatedUser = User::find($authenticatedUserId);
        $gameToAccept = $authenticatedUser->waitingGames()->find($id);
        if (!$gameToAccept)
           return response()->json('This Game is already accepted or not associated to this user.');
        $authenticatedUser->waitingGames()->updateExistingPivot($id, ['status'=>'Accepted']);
        return response()->json('Game accepted succefully.');
    }

    public function declineGame($id) {
        $authenticatedUserId = Auth::id();
        $authenticatedUser = User::find($authenticatedUserId);
        $gameToDecline = $authenticatedUser->waitingGames()->find($id);
        if (!$gameToDecline)
           return response()->json('This Game is already declined or not associated to this user.');
        $authenticatedUser->waitingGames()->updateExistingPivot($id, ['status'=>'Declined']);
        return response()->json('You are about to decline the game.');
    }

    public function setUserRole($id, Request $request) {
        //$request->user()->authorizeRoles(['admin', 'player']);
        $request->user()->authorizeRoles('admin');
        $player = User::find($id);
        $player->roles()->attach(Role::where('name', 'admin')->first());
    }

}
