<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Profile;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        $request->validate([
            'text' => 'required',
            'mission_id' => 'required|exists:missions,id',
            'profile_id' => 'required|exists:profiles,id',
        ]);


        $text = $request->input('text');
        $mission_id = $request->input('mission_id');
        $profile_id = $request->input('profile_id');

        $comment = new Comment();
        $comment->text = $text;
        $comment->profile_id = $profile_id;
        $comment->mission_id = $mission_id;
        $comment->save();

        return redirect()->back();
    }
}
