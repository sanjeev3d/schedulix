<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainCategoryService extends Model
{
    protected $table = 'main_category_service';

    protected $fillable = ['main_category_id','service_name'];
}
