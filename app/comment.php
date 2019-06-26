<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    //
    protected $table = 'comments';
    protected $fillable = ['ticket_id', 'comment', 'check_admin', 'own'];
    public static $rules = array(
  		//'title' => 'required|max:255',
  		//'ticket_id' => 'required|min:1|numeric',
  		//'check_admin' => 'required|min:1|numeric',
  		'comment' => 'required',
      'files.*' => 'mimes:jpeg,jpg,bmp,png,zip,doc,docx,rar,pdf|max:5120',
  		//'g-recaptcha-response' => 'required|recaptcha',
    );
  	public static function validate($input) {
  		//return validator($input, self::$rules, self::$messages);
  		return validator($input, self::$rules);
  	}
    public function file_comment()
    {
      # code...
      return $this->hasMany('App\file_comment', 'comment_id');
    }
}
