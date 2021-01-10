<?php
namespace App\Repositories\ViewComposer;

use Illuminate\View\View;
use App\Repositories\Setting\SettingRepository;
use Request;

class MasterComposer {
	// private $coverege;
	// private $detail;
	public function __construct(SettingRepository $setting){
		$this->setting=$setting;
		
	}
	public function compose(View $view) {
		$data = $view->getData(); 
		$value=$this->setting->first();
		
		if(!isset($data['og']) )
		{
			$og = array('title'=>'','description'=>'','keywords'=>'');
			
	                $og['title'] = $value->meta_title;
	                $og['description'] = $value->meta_description;
	                $og['image'] = '';
	               
		    $view->with(['og'=>$og]);
		}
		
	}
}