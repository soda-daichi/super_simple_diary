<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class showDiariesController extends Controller
{
    public function show(Request $request) {
         $diaries = DB::table('diaries')->get();

        return view('index', ['diaries' => $diaries]);
    }
}
