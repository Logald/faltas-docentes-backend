<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Turns
Route::post('/turns', 'App\Http\Controllers\TurnController@getTurns');
Route::post('/turns/{turn}', 'App\Http\Controllers\TurnController@getTurn');
Route::post('/turns/create', 'App\Http\Controllers\TurnController@create');
Route::put('/turns/{turn}', 'App\Http\Controllers\TurnController@update');
Route::delete('/turns/{turn}', 'App\Http\Controllers\TurnController@delete');
