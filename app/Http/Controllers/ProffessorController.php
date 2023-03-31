<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Proffessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProffessorController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getProffessors(Request $request)
  {
    $proffessors = Cache::remember('proffessors', CACHE_TIME, fn() => Proffessor::all());
    $args = [
      'id',
      'name',
      'lastname',
      'ci',
      'active'
    ];
    $data = getFromRequestIfExist($request, $args);
    $proffessors = searchMany($proffessors, $data);
    return response()->json($proffessors);
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
    $proffessor = new Proffessor();
    mergeObjects($request->keys(), $proffessor, $request->all());
    $proffessor->save();
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
    $args = [
      'name',
      'lastname',
      'ci',
      'active'
    ];
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
