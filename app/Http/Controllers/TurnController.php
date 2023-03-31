<?php

namespace App\Http\Controllers;

use App\Models\Turn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TurnController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getTurns(Request $request)
  {
    $turns = Cache::remember('turns', CACHE_TIME, fn() => Turn::all());
    $args = ['id', 'name'];
    $data = getFromRequestIfExist($request, $args);
    $turns = searchMany($turns, $data);
    return response()->json($turns);
  }

  /**
   * Display a resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getTurn(Turn $turn)
  {
    return response()->json($turn);
  }

  /**
   *
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function create(Request $request)
  {
    $turn = new Turn();
    mergeObjects($request->keys(), $turn, $request->all());
    $turn->save();
    return response()->json(true);
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Turn  $turn
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(Request $request, Turn $turn)
  {
    $args = ['name'];
    mergeObjects($args, $turn, $request);
    $turn->save();
    return response()->json(true);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Turn  $turn
   * @return \Illuminate\Http\JsonResponse
   */
  public function delete(Turn $turn)
  {
    $turn->delete();
    return response()->json(true);
  }
}
