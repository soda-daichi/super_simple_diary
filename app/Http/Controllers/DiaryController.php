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
            // 現在日時を××××-××-×× ○○:○○:○○に変換
            $title = $now->format('Y-m-d H:i:s');
            // 2021-10-19 23:29:52
            //  = Carbon::now()->format('Y-m-d'); // 現在の日付をYYYY-MM-DDの形式で取得
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

