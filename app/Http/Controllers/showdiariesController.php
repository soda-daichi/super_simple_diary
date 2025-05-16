<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Diary;

class showDiariesController extends Controller
{
    public function show(Request $request) {
         $diaries = DB::table('diaries')->get();

        return view('index', ['diaries' => $diaries]);
    }
    public function destroy(int $id){
        $diary = Diary::find($id);
        $diary->delete();
        session()->flash('success', '日記を削除しました！');
        return redirect('/');
    }
}
