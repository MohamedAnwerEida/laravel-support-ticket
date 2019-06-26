<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ticket_file extends Model
{
    //
    protected $table = 'ticket_file';
    protected $fillable = ['file', 'ticket_id'];

}
