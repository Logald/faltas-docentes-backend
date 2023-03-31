<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use App\Models\Matter;
use App\Models\Proffessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SpecialtyController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getSpecialties(Request $request)
  {
    $specialties = Cache::remember('specialties', CACHE_TIME, fn() => Specialty::all());
    $args = ['id', 'matterId', 'proffessorId'];
    $data = getFromRequestIfExist($request, $args);
    $specialties = searchMany($specialties, $data);
    return response()->json($specialties);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getSpecialtiesWithRelations(Request $request)
  {
    $specialties = Cache::remember('specialties', CACHE_TIME, fn() => Specialty::all());
    $args = ['id', 'matterId', 'proffessorId'];
    $data = getFromRequestIfExist($request, $args);
    $specialties = searchMany($specialties, $data);
    $specialtiesWithRelations = [];
    foreach ($specialties as $key => $specialty) {
      $specialty->matter = Matter::where('id', $specialty->matterId)->first();
      $specialty->proffessor = Proffessor::where('id', $specialty->proffessorId)->first();
      array_push($specialtiesWithRelations, $specialty);
    }
    return response()->json($specialtiesWithRelations);
  }

  /**
   * Display a resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getSpecialtyWithRelations(Specialty $specialty)
  {
    $specialty->matter = Matter::where('id', $specialty->matterId)->first();
    $specialty->proffessor = Proffessor::where('id', $specialty->proffessorId)->first();
    return response()->json($specialty);
  }

  /**
   * Display a resource.
   * @param Specialty $specialty
   * @return \Illuminate\Http\JsonResponse
   */
  public function getSpecialty(Specialty $specialty)
  {
    return response()->json($specialty);
  }

  /**
   *
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function create(Request $request)
  {
    $specialty = new Specialty();
    mergeObjects($request->keys(), $specialty, $request->all());
    $specialty->save();
    return response()->json(true);
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Specialty  $specialty
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(Request $request, Specialty $specialty)
  {
    $args = ['matterId', 'proffessorId'];
    mergeObjects($args, $specialty, $request);
    $specialty->save();
    return response()->json(true);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Specialty  $specialty
   * @return \Illuminate\Http\JsonResponse
   */
  public function delete(Specialty $specialty)
  {
    $specialty->delete();
    return response()->json(true);
  }
}
