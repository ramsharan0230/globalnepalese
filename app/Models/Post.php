<?php

namespace App\Models;
use App\Repositories\nepali_calendar;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{


    protected $table='posts';
    protected $fillable=['title','slug','description','meta_title','meta_description','image','publish','date','main_news','home','feature','view','short_description','banner1','banner2','link','image_link','reporter','tag_id','edited_by','publish_date','publish_time','order','reporter_image','reporter_fb','reporter_twitter', 'dateandtime'];


    public function categories(){
    	return $this->belongsToMany('App\Models\Category','category_posts','post_id','category_id');
    }
    public function youtubeVideo($url){
    	$url_string = parse_url($url, PHP_URL_QUERY);
  		parse_str($url_string, $args);
  		return isset($args['v']) ? $args['v'] : false;
    }
    public function imageLink($link){
        $value=explode('http://localhost:8000/images/main/' ,$image_link);
        return $value[1];
    }
    public function strip_tags_content($text, $tags = '', $invert = FALSE) { 

        preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags); 
        $tags = array_unique($tags[1]); 

        if(is_array($tags) AND count($tags) > 0) { 
		    if($invert == FALSE) { 
		      return preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text); 
		    } 
		    else { 
		      return preg_replace('@<('. implode('|', $tags) .')\b.*?>.*?</\1>@si', '', $text); 
		    } 
	  	} 
		elseif($invert == FALSE) { 
		    return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text); 
		} 
  		return $text; 
	} 
    public function getNepaliDate($date){
        
        $explodedValue=explode('-',$date);
        //dd($explodedValue[1]);
        $day_explode = explode(" ",$explodedValue[2]);
        //dd($day_explode);
        $calendar=new nepali_calendar;
        $nepali_date = $calendar->eng_to_nep($explodedValue[0],$explodedValue[1],$day_explode[0]);
        return $nepali_date['year'].'-'.$nepali_date['month'].'-'.$nepali_date['date'];
    }
}
