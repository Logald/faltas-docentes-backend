<?php

use Illuminate\Database\Eloquent\Collection;

/**
 * @param Collection $data
 * @param array $param
 *
 */


if (!function_exists('searchMany')) {
  function searchMany(Collection $data, array $args)
  {
    foreach ($args as $key => $value) {
      if (isset($args['startDate'])) {
        $data = $data->where($key, '>=', $value);
        continue;
      }
      if (isset($args['endDate'])) {
        $data = $data->where($key, '<=', $value);
        continue;
      }
      $data = $data->where($key, '=', $value);
    }
    if (count($data) == 1) {
      $formatData = [];
      foreach ($data as $key => $value) {
        array_push($formatData, $data[$key]);
      }
      return $formatData;
    }
    return $data;
  }
}
