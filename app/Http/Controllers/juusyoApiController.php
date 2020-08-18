<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class juusyoApiController extends Controller
{
  public function search() {

    return view('search');
  }
  public function kensaku(Request $request) {
    $first_code = $request->first_code;
    $last_code = $request->last_code;
    $test = DB::table('postal_codes')->where([
      ['first_code', '=', $first_code ],
      ['last_code', '=', $last_code]
      ])->first();
      $data = json_encode($test,JSON_PRETTY_PRINT);
      return $data;
    // return view('search', compact('data'));
  }
}
