<?php

namespace App\Http\Controllers;

use App\Models\Matter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MatterController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getMatters(Request $request)
  {
    $matters = Cache::remember('matters', CACHE_TIME, fn() => Matter::all());
    $args = ['id', 'name', 'description'];
    $data = getFromRequestIfExist($request, $args);
    $matters = searchMany($matters, $data);
    return response()->json($matters);
  }

  /**
   * Display a resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getMatter(Matter $matter)
  {
    return response()->json($matter);
  }

  /**
   *
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function create(Request $request)
  {
    $matter = new Matter();
    mergeObjects($request->keys(), $matter, $request->all());
    $matter->save();
    return response()->json(true);
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Matter  $matter
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(Request $request, Matter $matter)
  {
    $args = ['name', 'description'];
    mergeObjects($args, $matter, $request);
    $matter->save();
    return response()->json(true);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Matter  $matter
   * @return \Illuminate\Http\JsonResponse
   */
  public function delete(Matter $matter)
  {
    $matter->delete();
    return response()->json(true);
  }
}
