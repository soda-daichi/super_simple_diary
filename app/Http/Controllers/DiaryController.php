<?php

namespace App\Http\Controllers;

use App\Diary;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DiaryController extends Controller
{
    public function create(Request $request)
    {

        return view("create");
    }
    public function add(Request $request)
    {
        $title = $request->input('title');

        if (empty($title)) {
            $now = Carbon::now();
            $title = $now->format('Y-m-d H:i:s');
        }

        $request->validate([
            "contents" => "required",
        ]);

        $diary = new Diary();

        $diary->title = $title;
        $diary->contents = $request->contents;

        $diary->save();
        return redirect('/'); //とりあえずトップページに戻る。
    }
}

