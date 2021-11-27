<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function viewMission(Request $request)
    {
        return view('mission');
    }
}
