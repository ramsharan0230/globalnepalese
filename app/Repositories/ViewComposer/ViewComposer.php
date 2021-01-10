<?php
namespace App\Repositories\ViewComposer;
use App\Repositories\Setting\SettingRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\nepali_calendar;
use App\Repositories\Tag\TagRepository;
use App\Repositories\Team\TeamRepository;
use App\Repositories\Advert\AdvertRepository;
use Illuminate\View\View;

class ViewComposer {
	private $dashboard;
	
	public function __construct(SettingRepository $setting,nepali_calendar $calendar,CategoryRepository $category,TagRepository $tag,TeamRepository $team,AdvertRepository $advert) {
		$this->setting=$setting;
		$this->calendar=$calendar;
		$this->category=$category;
		$this->tag=$tag;
		$this->team=$team;
		$this->advert = $advert;

	}
	public function compose(View $view) {
		$dashboard=$this->setting->first();
		$calendar= $this->calendar;
		$team=$this->team->where('publish',1)->get();
		//dd($team);
		$category=$this->category->orderBy('created_at','desc')->where('publish',1)->take(10)->get();
		$tag=$this->tag->orderBy('created_at','desc')->where('publish',1)->take(5)->get();
		$advert = $this->advert->where('publish',1);
		$view->with(['dashboard_composer'=>$dashboard,'calendar'=>$calendar,'dashboard_category'=>$category,'dashboard_tag'=>$tag,'dashboard_team'=>$team,'dashboard_advert'=>$advert]);
	}
	
}
