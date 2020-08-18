<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\post_code;
class startApiController extends Controller
{
  public function kensaku(Request $request) {
    $first_code = $request->first_code;
    $last_code = $request->last_code;
    $i = 0;
    $count = count($first_code);
    while ($i < $count) {
      if ($i < 10) {
        DB::beginTransaction();
        try {
          $test = DB::table('postal_codes')->where([
            ['first_code', '=', $first_code[$i]],
            ['last_code', '=', $last_code[$i]]
            ])->first();
          DB::commit();
        } catch (\Exception $e) {
          DB::rollback();
        }
        $data[] = json_encode($test, JSON_UNESCAPED_UNICODE);
      }else {
        $data[] = '一度に10件までしか処理できません';
        return $data;
      }
      $i ++;
    }
    return $data;
  }
}
