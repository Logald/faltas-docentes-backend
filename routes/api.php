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


// user
Route::post('/users/signup', 'App\Http\Controllers\AuthController@signup');
Route::post('/users/signin', 'App\Http\Controllers\AuthController@signin');

Route::middleware(['auth:sanctum'])->group(function () {
  // Auth routes
  // Turns
  Route::post('/turns', 'App\Http\Controllers\TurnController@getTurns');
  Route::post('/turns/create', 'App\Http\Controllers\TurnController@create');
  Route::get('/turns/{turn}', 'App\Http\Controllers\TurnController@getTurn');
  Route::put('/turns/{turn}', 'App\Http\Controllers\TurnController@update');
  Route::delete('/turns/{turn}', 'App\Http\Controllers\TurnController@delete');

  // Matters
  Route::post('/matters', 'App\Http\Controllers\MatterController@getMatters');
  Route::post('/matters/create', 'App\Http\Controllers\MatterController@create');
  Route::get('/matters/{matter}', 'App\Http\Controllers\MatterController@getMatter');
  Route::put('/matters/{matter}', 'App\Http\Controllers\MatterController@update');
  Route::delete('/matters/{matter}', 'App\Http\Controllers\MatterController@delete');

  // people
  Route::post('/people', 'App\Http\Controllers\PersonController@getPeople');
  Route::post('/people/create', 'App\Http\Controllers\PersonController@create');
  Route::get('/people/{person}', 'App\Http\Controllers\PersonController@getPerson');
  Route::put('/people/{person}', 'App\Http\Controllers\PersonController@update');
  Route::delete('/people/{person}', 'App\Http\Controllers\PersonController@delete');

  // proffessor
  Route::post('/proffessors', 'App\Http\Controllers\ProffessorController@getProffessors');
  Route::post('/proffessors/create', 'App\Http\Controllers\ProffessorController@create');
  Route::get('/proffessors/{proffessor}', 'App\Http\Controllers\ProffessorController@getProffessor');
  Route::put('/proffessors/{proffessor}', 'App\Http\Controllers\ProffessorController@update');
  Route::delete('/proffessors/{proffessor}', 'App\Http\Controllers\ProffessorController@delete');

  // group
  Route::post('/groups', 'App\Http\Controllers\GroupController@getGroups');
  Route::post('/groups/all', 'App\Http\Controllers\GroupController@getGroupsWithRelations');
  Route::post('/groups/create', 'App\Http\Controllers\GroupController@create');
  Route::get('/groups/{group}/all', 'App\Http\Controllers\GroupController@getGroupWithRelations');
  Route::get('/groups/{group}', 'App\Http\Controllers\GroupController@getGroup');
  Route::put('/groups/{group}', 'App\Http\Controllers\GroupController@update');
  Route::delete('/groups/{group}', 'App\Http\Controllers\GroupController@delete');

  // specialty
  Route::post('/specialties', 'App\Http\Controllers\SpecialtyController@getSpecialties');
  Route::post('/specialties/all', 'App\Http\Controllers\SpecialtyController@getSpecialtiesWithRelations');
  Route::post('/specialties/create', 'App\Http\Controllers\SpecialtyController@create');
  Route::get('/specialties/{specialty}/all', 'App\Http\Controllers\SpecialtyController@getSpecialtyWithRelations');
  Route::get('/specialties/{specialty}', 'App\Http\Controllers\SpecialtyController@getSpecialty');
  Route::put('/specialties/{specialty}', 'App\Http\Controllers\SpecialtyController@update');
  Route::delete('/specialties/{specialty}', 'App\Http\Controllers\SpecialtyController@delete');

  // mg
  Route::post('/mgs', 'App\Http\Controllers\MgController@getMgs');
  Route::post('/mgs/all', 'App\Http\Controllers\MgController@getMgsWithRelations');
  Route::post('/mgs/create', 'App\Http\Controllers\MgController@create');
  Route::get('/mgs/{mg}/all', 'App\Http\Controllers\MgController@getMgWithRelations');
  Route::get('/mgs/{mg}', 'App\Http\Controllers\MgController@getMg');
  Route::put('/mgs/{mg}', 'App\Http\Controllers\MgController@update');
  Route::delete('/mgs/{mg}', 'App\Http\Controllers\MgController@delete');

  // gmp
  Route::post('/gmps', 'App\Http\Controllers\GmpController@getGmps');
  Route::post('/gmps/all', 'App\Http\Controllers\GmpController@getGmpsWithRelations');
  Route::post('/gmps/create', 'App\Http\Controllers\GmpController@create');
  Route::get('/gmps/{gmp}/all', 'App\Http\Controllers\GmpController@getGmpWithRelations');
  Route::get('/gmps/{gmp}', 'App\Http\Controllers\GmpController@getGmp');
  Route::put('/gmps/{gmp}', 'App\Http\Controllers\GmpController@update');
  Route::delete('/gmps/{gmp}', 'App\Http\Controllers\GmpController@delete');

  // absence
  Route::post('/absences', 'App\Http\Controllers\AbsenceController@getAbsences');
  Route::post('/absences/all', 'App\Http\Controllers\AbsenceController@getAbsencesWithRelations');
  Route::post('/absences/create', 'App\Http\Controllers\AbsenceController@create');
  Route::get('/absences/{absence}/all', 'App\Http\Controllers\AbsenceController@getAbsenceWithRelations');
  Route::get('/absences/{absence}', 'App\Http\Controllers\AbsenceController@getAbsence');
  Route::put('/absences/{absence}', 'App\Http\Controllers\AbsenceController@update');
  Route::delete('/absences/{absence}', 'App\Http\Controllers\AbsenceController@delete');

});
