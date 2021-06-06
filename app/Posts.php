<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    //

    public function users() {

        return $this->belongsTo('App\Users');
    }
}
