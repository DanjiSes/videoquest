<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function viewMission(int $id, Request $request)
    {
        $soc_type = $request->get('utm_s_type');
        $soc_uid = $request->get('utm_s_uid');

        $mission = Mission::findOrFail($id);
        $content = json_decode($mission->content);

        return view('mission', [
            'content' => $content,
            'comments' => $mission->comments,
            'soc_type' => $soc_type,
            'soc_uid' => $soc_uid,
            'mission_id' => $mission->id
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
