<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Gmp;
use App\Models\Turn;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AbsenceController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getAbsences(Request $request)
  {
    $absences = Absence::all();
    $args = ['id', 'gmpId', 'turnId', 'startDate', 'endDate', 'reason', 'active'];
    $data = getFromRequestIfExist($request, $args);
    $absences = searchMany($absences, $data);
    return response()->json($absences);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getAbsencesWithRelations(Request $request)
  {
    $absences = Absence::all();
    $args = ['id', 'gmpId', 'turnId', 'startDate', 'endDate', 'reason', 'active'];
    $data = getFromRequestIfExist($request, $args);
    $absences = searchMany($absences, $data);
    $mgsWithRelations = [];
    foreach ($absences as $key => $absence) {
      $absence->gmp = Gmp::where('id', $absence->gmpId)->first();
      $absence->turn = Turn::where('id', $absence->turnId)->first();
      array_push($mgsWithRelations, $absence);
    }
    return response()->json($mgsWithRelations);
  }

  /**
   * Display a resource.
   * @param Absence $absence
   * @return \Illuminate\Http\JsonResponse
   */
  public function getAbsenceWithRelations(Absence $absence)
  {
    $absence->gmp = Gmp::where('id', $absence->gmpId)->first();
    $absence->turn = Turn::where('id', $absence->turnId)->first();
    return response()->json($absence);
  }

  /**
   * Display a resource.
   * @param Absence $absence
   * @return \Illuminate\Http\JsonResponse
   */
  public function getAbsence(Absence $absence)
  {
    return response()->json($absence);
  }

  /**
   *
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function create(Request $request)
  {
    Absence::create([
      'gmpId' => $request->gmpId,
      'turnId' => $request->turnId,
      'startDate' => $request->startDate,
      'endDate' => $request->endDate,
      'reason' => $request->reason,
      'active' => $request->active
    ]);
    return response()->json(true);
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Absence  $absence
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(Request $request, Absence $absence)
  {
    $args = ['gmpId', 'turnId', 'startDate', 'endDate', 'reason', 'active'];
    mergeObjects($args, $absence, $request);
    $absence->save();
    return response()->json(true);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Absence  $absence
   * @return \Illuminate\Http\JsonResponse
   */
  public function delete(Absence $absence)
  {
    $absence->delete();
    return response()->json(true);
  }
}
