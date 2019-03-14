<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Game;
use App\Comment;
use Auth;
use App\Http\Resources\Comment as CommentResource;

class CommentController extends Controller
{
    public function showCommentsInGame(Request $request) {
        $game_id = $request->input('game_id');
        $comments = Game::find($game_id)->comments;
        return CommentResource::collection($comments);
    }
    public function store(Request $request) {
        $comment = new Comment();
        $comment->game_id= $request->game_id;
        $comment->user_id= Auth::id();
        $comment->content= $request->content;
        $comment->save();
        return CommentResource::collection($comment);
    }
    public function destroy(Request $request) {
        $comment_id = $request->input('comment_id');
        $comment = Comment::find($comment_id);
        if($comment && $comment->delete())
          return response()->json('This comment is succfully deleted.');
        return response()->json('This comment is not found.');
    }
}
