<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use App\Game;
use App\User;
use App\Http\Resources\Game as GameResource;

class GameController extends Controller
{
    public function getAllGames(Request $request) {
        $authenticatedUserId = Auth::id();
        $authenticatedUser = User::find($authenticatedUserId);
        $allGames = $authenticatedUser->games;
        return GameResource::collection($allGames);
    }

    public function getAcceptedGames()
    {
       $authenticatedUserId = Auth::id();
       $authenticatedUser = User::find($authenticatedUserId);
       $acceptedGames = $authenticatedUser->acceptedGames;
       return GameResource::collection($acceptedGames);
    }

    public function store(Request $request)
    {
        /*$game = $request->isMethod('put') ? Game::findOrFail($request->game_id) : new Game;
        $game->id = $request->input('game_id');*/
        $game = new Game();
        $game->creator_id = Auth::id();
        $game->stadium_id = $request->input('stadium_id');
        $game->game_title = $request->input('game_title');
        $game->description = $request->input('description');
        $game->price_per_person = $request->input('price_per_person');
        $game->date = $request->input('date');
        $game->time = $request->input('time');
        $game->duration = $request->input('duration');
        $game->players_number_per_team = $request->input('players_number_per_team');
        $game->total_players_number = $request->input('total_players_number'); //nb slots
        $game->is_weekly = $request->input('is_weekly');
        $game->is_public = $request->input('is_public');
        $game->is_joinable = $request->input('is_joinable');
        if ($game->save())
            return new GameResource($game);
        else
            return response()->json('An error occured.');
    }

    public function show(Request $request)
    {
        $game_id = $request->input('game_id');
        $game = Game::find($game_id);
        if($game)
            return new GameResource($game);
        else
            return response()->json('This game is not found.');
    }

    public function destroy(Request $request)
    {
        $game_id = $request->input('game_id');
        $game = Game::find($game_id);
        if($game) {
            //dd($game->users);
            $game->users()->detach();
            $game->delete();
            return response()->json('This game is succfully deleted.');
        }
        else
            return response()->json('This game is not found.');
    }
}
