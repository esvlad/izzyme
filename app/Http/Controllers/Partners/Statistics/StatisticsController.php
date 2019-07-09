<?php

namespace App\Http\Controllers\Partners\Statistics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{
    public function view(){
      return view('partners.statistics.index');
    }

    public function getCountPosts(){
      $msg = 'Hello World!';
      return response()->json(array('msg'=> $msg), 200);
    }
}
