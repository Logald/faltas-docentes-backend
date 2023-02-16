<?php

namespace App\Http\Controllers;

use App\Models\Turn;
use Illuminate\Http\Request;

class TurnController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getTurns(Request $request)
  {
    $turns = Turn::all();
    $args = [];
    if (isset($request['id']))
      $args['id'] = $request->id;
    if (isset($request['name']))
      $args['name'] = $request->name;
    $data = searchMany($turns, $args);
    return response()->json($data);
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
    Turn::create([
      'name' => $request->name
    ]);
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
    $turn->name = $request->name;
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
