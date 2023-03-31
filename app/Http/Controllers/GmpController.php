<?php

namespace App\Http\Controllers;

use App\Models\Gmp;
use App\Models\Mg;
use App\Models\Proffessor;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Cache;

class GmpController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getGmps(Request $request)
  {
    $gmps = Cache::remember('gmps', CACHE_TIME, fn() => Gmp::all());
    $args = ['id', 'mgId', 'proffessorId', 'active'];
    $data = getFromRequestIfExist($request, $args);
    $gmps = searchMany($gmps, $data);
    return response()->json($gmps);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getGmpsWithRelations(Request $request)
  {
    $gmps = Cache::remember('gmps', CACHE_TIME, fn() => Gmp::all());
    $args = ['id', 'mgId', 'proffessorId', 'active'];
    $data = getFromRequestIfExist($request, $args);
    $gmps = searchMany($gmps, $data);
    $gmpsWithRelations = [];
    foreach ($gmps as $key => $gmp) {
      $gmp->mg = Mg::where('id', $gmp->mgId)->first();
      $gmp->proffessor = Proffessor::where('id', $gmp->proffessorId)->first();
      array_push($gmpsWithRelations, $gmp);
    }
    return response()->json($gmpsWithRelations);
  }

  /**
   * Display a resource.
   * @param Gmp $gmp
   * @return \Illuminate\Http\JsonResponse
   */
  public function getGmpWithRelations(Gmp $gmp)
  {
    $gmp->mg = Mg::where('id', $gmp->mgId)->first();
    $gmp->proffessor = Proffessor::where('id', $gmp->proffessorId)->first();
    return response()->json($gmp);
  }

  /**
   * Display a resource.
   * @param Gmp $gmp
   * @return \Illuminate\Http\JsonResponse
   */
  public function getGmp(Gmp $gmp)
  {
    return response()->json($gmp);
  }

  /**
   *
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function create(Request $request)
  {
    $exists = Gmp::where('mgId', $request->mgId)->where('active', true)->first();
    if (!$exists) {
      $gmp = new Gmp();
      mergeObjects($request->keys(), $gmp, $request->all());
      $gmp->save();
      return response()->json(true);
    }
    return throw new HttpException(302, 'Exist');
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Gmp  $gmp
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(Request $request, Gmp $gmp)
  {
    if (isset($request->active) && $request->active == true) {
      $exists = Gmp::where('mgId', $gmp->mgId)->where('active', true)->first();
      if ($exists)
        return throw new HttpException(302, 'Exist');
    }
    $args = ['mgId', 'proffessorId', 'active'];
    mergeObjects($args, $gmp, $request);
    $gmp->save();
    return response()->json(true);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Gmp  $gmp
   * @return \Illuminate\Http\JsonResponse
   */
  public function delete(Gmp $gmp)
  {
    $gmp->delete();
    return response()->json(true);
  }
}
