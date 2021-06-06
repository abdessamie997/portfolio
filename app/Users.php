<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    // for define model to table:
    protected $table = 'users';

    // for define model to column:
    protected $primaryKey = 'id';

    public function posts() {

        return $this->hasMany('App\Posts');
    }
}
