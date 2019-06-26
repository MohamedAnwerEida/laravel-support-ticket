<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    //
    protected $table = 'ticket';
    protected $fillable = ['title', 'text', 'important', 'category', 'user_id'];
    public static $rules = array(
  		'title' => 'required|max:255',
  		'category' => 'required|min:1|numeric',
  		'text' => 'required',
        'files.*' => 'mimes:jpeg,jpg,bmp,png,zip,doc,docx,rar,pdf|max:5120',
  		//'mobile' => 'required|mobile_number',
  		//'g-recaptcha-response' => 'required|recaptcha',
    );
  	public static function validate($input) {
  		//return validator($input, self::$rules, self::$messages);
  		return validator($input, self::$rules);
  	}
    public function ticket_file()
    {
      # code...
      return $this->hasMany('App\ticket_file', 'ticket_id');
    }
    public function categoryName()
    {
      # code...
      return $this->belongsTo('App\category','category');
    }
    public function comments()
    {
      # code...
      return $this->hasMany('App\comment','ticket_id');
    }
    public function user()
    {
      # code...
      return $this->belongsTo('App\user','user_id');
    }
    

}
