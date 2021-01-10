<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table='categories';
    protected $fillable=['title','publish','slug','header','meta_description','meta_title','main','order'];

    public function posts()
    {
		return $this->belongsToMany('App\Models\Post', 'category_posts','category_id','post_id');
    }
}
