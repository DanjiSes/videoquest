<?php

use App\Models\Mission;
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

Route::get('/admin/missions/create', function () {
    return view('admin.mission.create');
})->name('createMissionForm');

Route::get('/admin/missions/{id}/edit', function ($id) {
    $mission = Mission::findOrFail($id);
    return view('admin.mission.edit', ['mission' => $mission]);
})->name('editMissionForm');

Route::get('/admin/missions/list', function () {
    $missions = Mission::orderBy('created_at', 'desc')->get();
    return view('admin.mission.list', ['missions' => $missions]);
})->name('missionsList');

Route::post('/missions', 'MissionController@createMission')->name('createMission');
Route::post('/missions/{id}/edit', 'MissionController@editMission')->name('editMission');

// Add comments

Route::post('/comments', 'CommentController@createComment')->name('createComment');
