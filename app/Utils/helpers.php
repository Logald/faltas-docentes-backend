<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * @param Collection $data
 * @param array $param
 *
 */


if (!function_exists('searchMany')) {
  function searchMany(Collection $data, array $args)
  {
    foreach ($args as $key => $value) {
      if ($key === 'startDate') {
        $data = $data->where($key, '>=', $value);
        continue;
      }
      if ($key === 'endDate') {
        $data = $data->where($key, '<=', $value);
        continue;
      }
      $data = $data->where($key, '=', $value);
    }
    if (!isset($data[0]->id)) {
      $formatData = [];
      foreach ($data as $key => $value) {
        array_push($formatData, $data[$key]);
      }
      return $formatData;
    }
    return $data;
  }
}

/**
 * @param Request $request
 * @param array $params
 * @return array
 */


if (!function_exists('getFromRequestIfExist')) {
  function getFromRequestIfExist(Request $request, array $params)
  {
    $data = [];
    foreach ($params as $key => $value) {
      if (isset($request[$value]))
        $data[$value] = $request[$value];
    }
    return $data;
  }
}

/**
 * Merge object1 with object2
 *
 * @param array $params
 * @param object $object1
 * @param object $object2
 *
 */

if (!function_exists('mergeObjects')) {
  function mergeObjects(array $params, object &$object1, object $object2)
  {
    foreach ($params as $key => $value) {
      if (isset($object2[$value]))
        $object1[$value] = $object2[$value];
    }
  }
}
