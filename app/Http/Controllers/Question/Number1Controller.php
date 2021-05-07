<?php

namespace App\Http\Controllers\Question;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Number1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $objects = DB::table('tbl_data AS a')
        ->selectRaw("
                a.barcode,
                COUNT(a.id) AS jumlah,
                SUM(a.price) AS total_harga,
                (SELECT COUNT(b.status) FROM tbl_data AS b WHERE b.status='READY' AND b.barcode=a.barcode) AS ready,
                (SELECT COUNT(c.status) FROM tbl_data AS c WHERE c.status='ONHOLD' AND c.barcode=a.barcode) AS onhold,
                (SELECT COUNT(d.status) FROM tbl_data AS d WHERE d.status='DELIVERED' AND d.barcode=a.barcode) AS delivered,
                (SELECT COUNT(e.status) FROM tbl_data AS e WHERE e.status='PACKING' AND e.barcode=a.barcode) AS packing,
                (SELECT COUNT(f.status) FROM tbl_data AS f WHERE f.status='SENT' AND f.barcode=a.barcode) AS sent
        ")
        ->groupBy('a.barcode')
        ->get();
        
        return view('Question.number1.index', compact('objects'));
    }

}
