<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $table='dashboards';
   	protected $fillable=['facebook','twitter','address','phone','email','youtube','instagram','fav_icon','logo','meta_description','meta_title','map','num_banner_1','num_banner_2'];

   	public function youtubeVideo($url){
    	$url_string = parse_url($url, PHP_URL_QUERY);
  		parse_str($url_string, $args);
  		return isset($args['v']) ? $args['v'] : false;
    }
}
