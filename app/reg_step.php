<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reg_step extends Model
{
    //
    protected $table = 'reg_step';
    protected $fillable = ['user_id','step','status'];
}
