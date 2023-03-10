<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getPeople(Request $request)
  {
    $people = Person::all();
    $args = ['id', 'name', 'lastname', 'ci'];
    $data = getFromRequestIfExist($request, $args);
    $people = searchMany($people, $data);
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
    $args = ['name', 'lastname', 'ci'];
    mergeObjects($args, $person, $request);
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
