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
Route::post('/turns/create', 'App\Http\Controllers\TurnController@create');
Route::post('/turns/{turn}', 'App\Http\Controllers\TurnController@getTurn');
Route::put('/turns/{turn}', 'App\Http\Controllers\TurnController@update');
Route::delete('/turns/{turn}', 'App\Http\Controllers\TurnController@delete');

// Matters
Route::post('/matters', 'App\Http\Controllers\MatterController@getMatters');
Route::post('/matters/create', 'App\Http\Controllers\MatterController@create');
Route::post('/matters/{matter}', 'App\Http\Controllers\MatterController@getMatter');
Route::put('/matters/{matter}', 'App\Http\Controllers\MatterController@update');
Route::delete('/matters/{matter}', 'App\Http\Controllers\MatterController@delete');

// people
Route::post('/people', 'App\Http\Controllers\PersonController@getPeople');
Route::post('/people/create', 'App\Http\Controllers\PersonController@create');
Route::post('/people/{person}', 'App\Http\Controllers\PersonController@getPerson');
Route::put('/people/{person}', 'App\Http\Controllers\PersonController@update');
Route::delete('/people/{person}', 'App\Http\Controllers\PersonController@delete');

// proffessor
Route::post('/proffessors', 'App\Http\Controllers\ProffessorController@getProffessors');
Route::post('/proffessors/all', 'App\Http\Controllers\ProffessorController@getProffessorsWithRelations');
Route::post('/proffessors/create', 'App\Http\Controllers\ProffessorController@create');
Route::post('/proffessors/{proffessor}/all', 'App\Http\Controllers\ProffessorController@getProffessorWithRelations');
Route::post('/proffessors/{proffessor}', 'App\Http\Controllers\ProffessorController@getProffessor');
Route::put('/proffessors/{proffessor}', 'App\Http\Controllers\ProffessorController@update');
Route::delete('/proffessors/{proffessor}', 'App\Http\Controllers\ProffessorController@delete');

// group
Route::post('/groups', 'App\Http\Controllers\GroupController@getGroups');
Route::post('/groups/all', 'App\Http\Controllers\GroupController@getGroupsWithRelations');
Route::post('/groups/create', 'App\Http\Controllers\GroupController@create');
Route::post('/groups/{group}/all', 'App\Http\Controllers\GroupController@getGroupWithRelations');
Route::post('/groups/{group}', 'App\Http\Controllers\GroupController@getGroup');
Route::put('/groups/{group}', 'App\Http\Controllers\GroupController@update');
Route::delete('/groups/{group}', 'App\Http\Controllers\GroupController@delete');
