<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * 1. View mission
 *
 * 2. Add new mission & edit mission & delete mission
 * 3. View missions list
 *
 * 4. Add comment
 */

// View mission
Route::get('/', function () {
    return redirect(route('createMissionForm'));
});

Route::get('/mission/{id}', 'MissionController@viewMission')->name('viewMission');

// Missions CRUD

Route::get('/missions/create', function () {
    return view('mission-create');
})->name('createMissionForm');

Route::post('/missions', 'MissionController@createMission')->name('createMission');

// Add comments

Route::post('/comments', 'CommentController@createComment')->name('createComment');

Route::get('/proxy', function (Request $request) {
    $url = $request->input('url');
    readfile('http://corsproxy:8080/');
});
