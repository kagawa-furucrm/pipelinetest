<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkedSocialAccount extends Model
{
	public function accounts(){
    		return $this->hasMany('App\LinkedSocialAccount');
	}
}
