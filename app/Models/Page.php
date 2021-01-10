<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title','slug','description','image','meta_title','meta_description','short_description','main','type','publish'];
}
