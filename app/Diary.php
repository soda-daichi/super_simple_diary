<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Post;

class Diary extends Model
{
    protected $table = 'diaries';
    protected $fillable = [
        'title',
        'contents',
    ];
}
