<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MissionController@getMission')->name('getMission');
