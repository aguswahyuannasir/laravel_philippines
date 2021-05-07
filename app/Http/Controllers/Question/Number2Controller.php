<?php

namespace App\Http\Controllers\Question;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Number2Controller extends Controller
{
    public function index() {
 
        $objects = DB::table('tbl_arr')
        ->select('arr')
        ->get();

        $arr=[];
        $i=0;
        foreach($objects as $ls){
            $arr[$i] = $ls->arr;
            $i++;
        }

        $result = [];
        for($j=0;$j<count($arr);$j++){
            if($arr[$j] < 0){
                $cek = (int) $arr[$j] * -1;
                $find = array_search($cek,$arr);
                $result[] = $arr[$find];
            }
        }
  
        return view('Question.number2.index', compact('arr','result'));
    }

}
