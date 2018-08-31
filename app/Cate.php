<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    //
    public function articles()
    {
    	return $this->hasMany('App\Article');
    }
}
