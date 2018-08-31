<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];
	
    //
    public function tags()
    {
    	return $this->belongsToMany('App\Tag');
    }

    public function cate()
    {
    	return $this->belongsTo('App\Cate');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
