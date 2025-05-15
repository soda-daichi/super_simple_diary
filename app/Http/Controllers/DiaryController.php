<?php

namespace App\Http\Controllers;

use App\Diary;
use App\Diarys;
use Illuminate\Http\Request;

class DiaryController extends Controller
{
    public function create(Request $request){
        return view("create");
    }
   public function add(Request $request){
        $diary = new Diary();

        $diary->title = $request->title;
        $diary->contents = $request->contents;

        $diary->save();
        return redirect('/'); //とりあえずトップページに戻る。
    }
}

