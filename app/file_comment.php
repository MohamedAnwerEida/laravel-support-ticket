<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class file_comment extends Model
{
    //
    protected $table = 'file_comment';
    protected $fillable = ['file', 'comment_id'];

}
