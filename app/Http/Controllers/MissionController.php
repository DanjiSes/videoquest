<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function viewMission(int $id)
    {
        return view('mission', ['id' => $id]);
    }
}
