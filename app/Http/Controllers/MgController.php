<?php

namespace App\Http\Controllers;

use App\Models\Mg;
use App\Models\Matter;
use App\Models\Group;
use Illuminate\Http\Request;

class MgController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getMgs(Request $request)
  {
    $mgs = Mg::all();
    $args = ['id', 'matterId', 'groupId'];
    $data = getFromRequestIfExist($request, $args);
    $mgs = searchMany($mgs, $data);
    return response()->json($mgs);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getMgsWithRelations(Request $request)
  {
    $mgs = Mg::all();
    $args = ['id', 'matterId', 'groupId'];
    $data = getFromRequestIfExist($request, $args);
    $mgs = searchMany($mgs, $data);
    $mgsWithRelations = [];
    foreach ($mgs as $key => $mg) {
      $mg->matter = Matter::where('id', $mg->matterId)->first();
      $mg->group = Group::where('id', $mg->groupId)->first();
      array_push($mgsWithRelations, $mg);
    }
    return response()->json($mgsWithRelations);
  }

  /**
   * Display a resource.
   * @param Mg $mg
   * @return \Illuminate\Http\JsonResponse
   */
  public function getMgWithRelations(Mg $mg)
  {
    $mg->matter = Matter::where('id', $mg->matterId)->first();
    $mg->group = Group::where('id', $mg->groupId)->first();
    return response()->json($mg);
  }

  /**
   * Display a resource.
   * @param Mg $mg
   * @return \Illuminate\Http\JsonResponse
   */
  public function getMg(Mg $mg)
  {
    return response()->json($mg);
  }

  /**
   *
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function create(Request $request)
  {
    Mg::create([
      'matterId' => $request->matterId,
      'groupId' => $request->groupId
    ]);
    return response()->json(true);
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Mg  $mg
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(Request $request, Mg $mg)
  {
    $args = ['matterId', 'groupId'];
    mergeObjects($args, $mg, $request);
    $mg->save();
    return response()->json(true);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Mg  $mg
   * @return \Illuminate\Http\JsonResponse
   */
  public function delete(Mg $mg)
  {
    $mg->delete();
    return response()->json(true);
  }
}
