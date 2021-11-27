<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        $soc_type = $request->input('utm_soc_type');
        $soc_uid = $request->input('utm_soc_uid');

        $profile = Profile::where('soc_type', $soc_type)->where('soc_uid', $soc_uid)->first();

        if ($profile === null) {
            $profile = new Profile();
            $profile->soc_type = $soc_type;
            $profile->soc_uid = $soc_uid;
            $profile->save();
        }

        $profile->loadInfo();

        // Create comment

        dd($profile, $soc_type, $soc_uid);
    }
}
