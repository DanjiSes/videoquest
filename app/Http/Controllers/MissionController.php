<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function viewMission(int $id)
    {
        $mission = Mission::findOrFail($id);
        $content = json_decode($mission->content);
        return view('mission', ['content' => $content]);
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
