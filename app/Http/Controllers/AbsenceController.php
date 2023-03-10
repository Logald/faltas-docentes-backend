<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Gmp;
use App\Models\Turn;
use Illuminate\Http\Request;
use DateTime;

class AbsenceController extends Controller
{
  private function endAbcenses()
  {
    $date = (new DateTime())->modify('-3 hour')->format('Y-m-d H-i-s');
    Absence::where('endDate', '<', $date)->where('active', true)->update(['active' => false]);
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getAbsences(Request $request)
  {
    $this->endAbcenses();
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
    $this->endAbcenses();
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
    $this->endAbcenses();
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
    $this->endAbcenses();
    return response()->json($absence);
  }

  /**
   *
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function create(Request $request)
  {
    $absence = new Absence();
    mergeObjects($request->keys(), $absence, $request->all());
    $absence->save();
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
