<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Profile;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function viewMission(int $id, Request $request)
    {
        $soc_type = $request->get('utm_s_type');
        $soc_uid = $request->get('utm_s_uid');
        $profile = null;

        if ($soc_type !== null && $soc_uid !== null) {
            $profile = Profile::where('soc_type', $soc_type)->where('soc_uid', $soc_uid)->first();

            if ($profile === null) {
                $profile = new Profile();
                $profile->soc_type = $soc_type;
                $profile->soc_uid = $soc_uid;
            }

            $profile->loadInfo();
            $profile->save();
        }

        $mission = Mission::findOrFail($id);
        $content = json_decode($mission->content);
        $comments = $mission->comments()->orderBy('created_at', 'desc')->get();

        return view('mission', [
            'content' => $content,
            'comments' => $comments,
            'mission_id' => $mission->id,
            'profile' => $profile
        ]);
    }

    public function createMission(Request $request)
    {
        $content = $request->input('content');

        $mission = new Mission();
        $mission->content = $content;
        $mission->save();

        return redirect(route('viewMission', ['id' => $mission->id]));
    }
}
