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
            'soc_type' => 'required',
            'soc_uid' => 'required',
            'text' => 'required',
            'mission_id' => 'required|exists:missions,id',
        ]);

        $soc_type = $request->input('soc_type');
        $soc_uid = $request->input('soc_uid');
        $text = $request->input('text');

        $profile = Profile::where('soc_type', $soc_type)->where('soc_uid', $soc_uid)->first();

        if ($profile === null) {
            $profile = new Profile();
            $profile->soc_type = $soc_type;
            $profile->soc_uid = $soc_uid;
            $profile->loadInfo();
            $profile->save();
        }

        $profile->loadInfo();
        $profile->save();

        $comment = new Comment();
        $comment->text = $text;
        $comment->profile_id = $profile->id;
        $comment->mission_id = $profile->id;
        $comment->save();

        return redirect()->back();
    }
}
