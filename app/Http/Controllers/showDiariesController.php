<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Diary;
use Carbon\Carbon;

class showDiariesController extends Controller
{
    public function show(Request $request) {
         $diaries = DB::table('diaries')->get();

        return view('index', ['diaries' => $diaries]);
    }
    public function destroy(int $id){
        $diary = Diary::find($id);
        $diary->delete();
        return redirect('/');
    }

     public function edit(int $id){
        $diary = Diary::find($id);
        
        return view('edit', [
           'diary' => $diary,
        ]);
    }
     public function update(int $id,Request $request){
        
        $title = $request->input('title');
        if (empty($title)) {
            $now = Carbon::now();
            $title = $now->format('Y-m-d H:i:s');
        }

        $request->validate([
            "contents" => "required",
        ]);

        $diary = Diary::find($id);

        $diary->title = $title;
        $diary->contents = $request->contents;
        $diary->save();
        return redirect('/'); //とりあえずトップページに戻る。
        
    }

}
