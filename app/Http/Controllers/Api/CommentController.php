<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Game;

class CommentController extends Controller
{
    public function showCommentsInGame($id) {
        Game::find($id);
    }
    public function store() {}
    public function destroy($id) {}
}
