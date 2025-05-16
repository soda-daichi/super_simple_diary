<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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
