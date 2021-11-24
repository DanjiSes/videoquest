<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function getMission(Request $request)
    {
        return view('mission');
    }
}
