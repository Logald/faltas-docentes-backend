<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PersonController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getPeople(Request $request)
  {
    $people = Cache::remember('people', CACHE_TIME, fn() => Person::all());
    $people = searchMany($people, $request->all());
    return response()->json($people);
  }

  /**
   * Display a resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getPerson(Person $person)
  {
    return response()->json($person);
  }

  /**
   *
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function create(Request $request)
  {
    $person = new Person();
    mergeObjects($request->keys(), $person, $request->all());
    $person->save();
    return response()->json(true);
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Person  $person
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(Request $request, Person $person)
  {
    mergeObjects($request->keys(), $person, $request->all());
    $person->save();
    return response()->json(true);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Person  $person
   * @return \Illuminate\Http\JsonResponse
   */
  public function delete(Person $person)
  {
    $person->delete();
    return response()->json(true);
  }
}
