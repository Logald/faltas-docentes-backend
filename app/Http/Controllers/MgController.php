<?php

namespace App\Http\Controllers;

use App\Models\Mg;
use App\Models\Matter;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MgController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getMgs(Request $request)
  {
    $mgs = Cache::remember('mgs', CACHE_TIME, fn() => Mg::all());
    $mgs = searchMany($mgs, $request->all());
    return response()->json($mgs);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getMgsWithRelations(Request $request)
  {
    $mgs = Cache::remember('mgs', CACHE_TIME, fn() => Mg::all());
    $mgs = searchMany($mgs, $request->all());
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
    $mg = new Mg();
    mergeObjects($request->keys(), $mg, $request->all());
    $mg->save();
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
    mergeObjects($request->keys(), $mg, $request->all());
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
