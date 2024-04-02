<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Books\BooksController;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ProductController;
use App\Models\Host;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth.basic')->group(function () {
    Route::apiResource('books', BooksController::class);
});

Route::get('/', function () {
    return response()->json([
        'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
    ]);
});

Route::get('/users', function ()  {      
    return "Hello";  
});  

Route::resource('host/users','App\Http\Controllers\HostController');
Route::resource('host/projects','App\Http\Controllers\ProjectController');
Route::get('host/projects/{project}/edit', 'App\Http\Controllers\ProjectController@edit')->name('projects.edit');




Route::get('/host/user/{user_id}/projects', function ($user_id) {
    $user = Host::find($user_id);
    $project1=[];
    foreach ($user->projects as $project)
    {
        array_push($project1, $project);
    }
    return response()->json($project1);
});


Route::resource('/products', ProductController::class);