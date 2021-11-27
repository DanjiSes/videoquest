<?php

use Illuminate\Support\Facades\Http;
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
Route::get('/mission/{id}', 'MissionController@viewMission')->name('viewMission');

// Missions CRUD

Route::get('/missions/create', function () {
    return view('mission-create');
})->name('createMissionForm');

Route::post('/missions', 'MissionController@createMission')->name('createMission');

// Add comments

Route::post('/comments', 'CommentController@createComment')->name('createComment');
