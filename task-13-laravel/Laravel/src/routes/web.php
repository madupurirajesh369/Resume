<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('/users','App\Http\Controllers\UserController');
Route::resource('/projects','App\Http\Controllers\ProjectController');
