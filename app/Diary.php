<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class Diary extends Model
{
    protected $table = 'diaries';
    protected $fillable = [
        'title',
        'contents',
        'created_at',
        'updated_at'
    ];
}
