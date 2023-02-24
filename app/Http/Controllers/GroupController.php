<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Turn;
use Illuminate\Http\Request;

class GroupController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getGroups(Request $request)
  {
    $groups = Group::all();
    $args = ['id', 'grade', 'name', 'description', 'turnId', 'active'];
    $data = getFromRequestIfExist($request, $args);
    $groups = searchMany($groups, $data);
    return response()->json($groups);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getGroupsWithRelations(Request $request)
  {
    $groups = Group::all();
    $args = ['id', 'grade', 'name', 'description', 'turnId', 'active'];
    $data = getFromRequestIfExist($request, $args);
    $groups = searchMany($groups, $data);
    $groupsWithRelations = [];
    foreach ($groups as $key => $group) {
      $group->turn = Turn::where('id', $group->turnId)->first();
      array_push($groupsWithRelations, $group);
    }
    return response()->json($groupsWithRelations);
  }

  /**
   * Display a resource.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function getGroupWithRelations(Group $group)
  {
    $group->turn = Turn::where('id', $group->turnId)->first();
    return response()->json($group);
  }

  /**
   * Display a resource.
   * @param Group $group
   * @return \Illuminate\Http\JsonResponse
   */
  public function getGroup(Group $group)
  {
    return response()->json($group);
  }

  /**
   *
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function create(Request $request)
  {
    Group::create([
      'grade' => $request->grade,
      'name' => $request->name,
      'description' => $request->description,
      'turnId' => $request->turnId,
      'active' => $request->active
    ]);
    return response()->json(true);
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Group  $group
   * @return \Illuminate\Http\JsonResponse
   */
  public function update(Request $request, Group $group)
  {
    $args = ['grade', 'name', 'description', 'turnId', 'active'];
    mergeObjects($args, $group, $request);
    $group->save();
    return response()->json(true);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Group  $group
   * @return \Illuminate\Http\JsonResponse
   */
  public function delete(Group $group)
  {
    $group->delete();
    return response()->json(true);
  }
}
