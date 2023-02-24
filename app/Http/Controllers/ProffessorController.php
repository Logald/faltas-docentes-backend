<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Proffessor;
use Illuminate\Http\Request;

class ProffessorController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getProffessors(Request $request)
  {
    $proffessors = Proffessor::all();
    $args = ['id', 'personId', 'active'];
    $data = getFromRequestIfExist($request, $args);
    $proffessors = searchMany($proffessors, $data);
    return response()->json($proffessors);
  }

  private function withRelations(object $proffessor)
  {
    $proffessor->person = Person::where('id', $proffessor->personId)->first();
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getProffessorsWithRelations(Request $request)
  {
    $proffessors = Proffessor::all();
    $args = ['id', 'personId', 'active'];
    $data = getFromRequestIfExist($request, $args);
    $proffessors = searchMany($proffessors, $data);
    $proffessorsWithRelations = [];
    foreach ($proffessors as $key => $proffessor) {
      $proffessor->person = Person::where('id', $proffessor->personId)->first();
      array_push($proffessorsWithRelations, $proffessor);
    }
    return response()->json($proffessorsWithRelations);
  }

  /**
   * Display a resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getPersonWithRelations(Proffessor $proffessor)
  {
    $proffessor->person = Person::where('id', $proffessor->personId)->first();
    return response()->json($proffessor);
  }

  /**
   * Display a resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getProffessor(Proffessor $proffessor)
  {
    return response()->json($proffessor);
  }

  /**
   *
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function create(Request $request)
  {
    Proffessor::create([
      'personId' => $request->personId,
      'active' => $request->active
    ]);
    return response()->json(true);
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Proffessor  $proffessor
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(Request $request, Proffessor $proffessor)
  {
    $args = ['personId', 'active'];
    mergeObjects($args, $proffessor, $request);
    $proffessor->save();
    return response()->json(true);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Proffessor  $proffessor
   * @return \Illuminate\Http\JsonResponse
   */
  public function delete(Proffessor $proffessor)
  {
    $proffessor->delete();
    return response()->json(true);
  }
}
