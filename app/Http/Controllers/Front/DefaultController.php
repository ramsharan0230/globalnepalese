<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Video\VideoRepository;
use App\Repositories\Post\PostRepository;
use App\Repositories\Photo\PhotoRepository;
use App\Repositories\Dashboard\DashboardRepository;
use App\Repositories\Tag\TagRepository;
use App\Repositories\Page\PageRepository;
use App\Repositories\Setting\SettingRepository;

class DefaultController extends Controller
{
	public function __construct(CategoryRepository $category,VideoRepository $video,PostRepository $post,PhotoRepository $photo,TagRepository $tag,SettingRepository $setting,PageRepository $page){
		$this->category=$category;
		$this->video=$video;
		$this->post=$post;
        $this->image=$photo;
        $this->tag=$tag;
        $this->setting=$setting;
        $this->page=$page;
	}
    public function index(){
        $dashboard=$this->setting->first();
        
    	$home1 = $this->post->where('banner1', 1)->where('publish', 1)->where('dateandtime', '<=', date('Y-m-d H:i'))->orderBy('id', 'desc')->take($dashboard->num_banner_1)->get();

        $home2 = $this->post->where('banner2', 1)->where('publish', 1)->where('dateandtime', '<=', date('Y-m-d H:i'))->orderBy('id', 'desc')->take($dashboard->num_banner_2)->get();


        $samachar = $this->category->with(['posts' => function ($query) {
            $query->orderBy('created_at', 'desc')->where('publish', 1)->where('dateandtime', '<=', date('Y-m-d H:i'))->take(5)->get();
        }])->find(1);

        //dristikon
        $dristikon = $this->category->with(['posts' => function ($query) {
            $query->orderBy('created_at', 'desc')->where('publish', 1)->where('dateandtime', '<=', date('Y-m-d H:i'))->take(5)->get();
        }])->find(2);

        //prabash
        $prabash = $this->category->with(['posts' => function ($query) {
            $query->orderBy('created_at', 'desc')->where('publish', 1)->where('dateandtime', '<=', date('Y-m-d H:i'))->take(3)->get();
        }])->find(3);

        //sahitya
        $sahitya = $this->category->with(['posts' => function ($query) {
            $query->orderBy('created_at', 'desc')->where('publish', 1)->where('dateandtime', '<=', date('Y-m-d H:i'))->take(4)->get();
        }])->find(4);

        //khelkud
        $khelkud = $this->category->with(['posts' => function ($query) {
            $query->orderBy('created_at', 'desc')->where('publish', 1)->where('dateandtime', '<=', date('Y-m-d H:i'))->take(4)->get();
        }])->find(5);

        //jiwanjagat
        $jiwanjagat = $this->category->with(['posts' => function ($query) {
            $query->orderBy('created_at', 'desc')->where('publish', 1)->where('dateandtime', '<=', date('Y-m-d H:i'))->take(5)->get();
        }])->find(6);

        //paryatan
        $paryatan = $this->category->with(['posts' => function ($query) {
            $query->orderBy('created_at', 'desc')->where('publish', 1)->where('dateandtime', '<=', date('Y-m-d H:i'))->take(5)->get();
        }])->find(7);

        //bazar
        $bazar = $this->category->with(['posts' => function ($query) {
            $query->orderBy('created_at', 'desc')->where('publish', 1)->where('dateandtime', '<=', date('Y-m-d H:i'))->take(5)->get();
        }])->find(8);

        // prabihi
        $prabidhi = $this->category->with(['posts' => function ($query) {
            return $query->orderBy('created_at', 'desc')->where('publish', 1)
                ->where('dateandtime', '<=', date('Y-m-d H:i'))->take(5)->get();
        }])->find(9);

        $feature = $this->category->with(['posts' => function ($query) {
            return $query->orderBy('created_at', 'desc')->where('publish', 1)
                ->where('dateandtime', '<=', date('Y-m-d H:i'))->take(4)->get();
        }])->find(10);


        // ----Debug----
        // dd(
        //     $samachar->posts,
        //     $dristikon->posts,
        //     $prabash->posts,
        //     $sahitya->posts,
        //     $khelkud->posts,
        //     $jiwanjagat->posts,
        //     $paryatan->posts,
        //     $bazar->posts,
        //     $prabidhi->posts
        // );

        //   $prabidhi=$this->category->with(['posts'=>function($query){
        //       $query->orderBy('created_at','desc')->where('publish',1)
        //         ->where(function ($query2) {
        //           $query2->where('dateandtime', '<=', date('Y-m-d H:i'))
        //                  ->orWhere('posts.id', '<', 16);
        //       })->take(5)->get();
        //     }])->find(9);

        //  --------OLD SAMPLES:-------

        //   $samachar=$this->category->with(['posts'=>function($query){
        //         $query->orderBy('created_at','desc')->where('publish',1)->take(5)->get();
        //     }])->find(1);

        //     //dristikon
        //     $dristikon=$this->category->with(['posts'=>function($query){
        //         $query->orderBy('created_at','desc')->where('publish',1)->take(3)->get();
        //     }])->find(2);

        //     //prabash
        //     $prabash=$this->category->with(['posts'=>function($query){
        //         $query->orderBy('created_at','desc')->where('publish',1)->take(5)->get();
        //     }])->find(3);

        //     //sahitya
        //     $sahitya=$this->category->with(['posts'=>function($query){
        //         $query->orderBy('created_at','desc')->where('publish',1)->take(9)->get();
        //     }])->find(4);

        //     //khelkud
        //     $khelkud=$this->category->with(['posts'=>function($query){
        //         $query->orderBy('created_at','desc')->where('publish',1)->take(4)->get();
        //     }])->find(5);

        //     //jiwanjagat
        //     $jiwanjagat=$this->category->with(['posts'=>function($query){
        //         $query->orderBy('created_at','desc')->where('publish',1)->take(5)->get();
        //     }])->find(6);

        //     //paryatan
        //     $paryatan=$this->category->with(['posts'=>function($query){
        //         $query->orderBy('created_at','desc')->where('publish',1)->take(5)->get();
        //     }])->find(7);

        //     //bazar
        //     $bazar=$this->category->with(['posts'=>function($query){
        //         $query->orderBy('created_at','desc')->where('publish',1)->take(5)->get();
        //     }])->find(8);
        //     //prabihi
        //     $prabidhi=$this->category->with(['posts'=>function($query){
        //         $query->orderBy('created_at','desc')->where('publish',1)->take(5)->get();
        //     }])->find(9);






        $videos = $this->video->orderBy('created_at', 'desc')->where('publish', 1)->take(1)->get();
        if ($videos) {

            $videos1 = $this->video->orderBy('created_at', 'desc')->where('publish', 1)->skip(1)->take(5)->get();
        } else {
            $videos1 = [];
        }




        $latest_news = $this->post->orderBy('created_at', 'desc')->where('publish', 1)->where('dateandtime', '<=', date('Y-m-d H:i'))->take(8)->get();
        $trendings = $this->post->where('publish', 1)->where('dateandtime', '<=', date('Y-m-d H:i'))->orderBy('view', 'desc')->take(8)->get();
        $images = $this->image->orderBy('created_at', 'desc')->where('publish', 1)->take(10)->get();
        return view('front.index', compact('home1', 'home2', 'samachar', 'dristikon', 'prabash', 'sahitya', 'khelkud', 'jiwanjagat', 'paryatan', 'bazar', 'prabidhi', 'videos', 'videos1', 'latest_news', 'trendings', 'feature'));
    }
    public function postInner($slug){
        
        $post=$this->post->where('slug',$slug)->first();
                
        if($post){
            $category=$post->categories;
            $category=$category->first();
            $related_posts=$category->posts()->where('publish',1)->where('post_id','!=',$post->id)->take(3)->get();
            $view=$post->view + 1;
            $post->view=$view;
            $post->save();
            $og['title']=$post->title;
            $og['description']=$post->short_description;
            $og['image']=$post->image;
            
            $latest_news=$this->post->orderBy('created_at','desc')->where('publish',1)->take(8)->get();
            $trendings=$this->post->where('publish',1)->orderBy('view','desc')->take(8)->get();
            $meta['title'] = $post->meta_title;
            $meta['description'] = $post->meta_description;
        
        return view('front.postInner',compact('post','latest_news','trendings','meta','og','related_posts'));
        }
        
    }
    public function category($slug){
        $category=$this->category->where('slug',$slug)->with(['posts'])->first();
        if($category){
            $posts=$category->posts()->orderBy('created_at','desc')->where('publish',1)->paginate(20);
            $latest_news=$this->post->orderBy('created_at','desc')->where('publish',1)->take(8)->get();
            $trendings=$this->post->where('publish',1)->orderBy('view','desc')->take(8)->get();
            return view('front.category',compact('category','trendings','latest_news','posts'));
        }
        abort(404);
        
    }
    public function trends($slug){
        $trend=$this->tag->where('slug',$slug)->with(['posts'])->first();
        //dd($trend->posts);
        if($trend){
            $posts=$trend->posts()->orderBy('created_at','desc')->where('publish',1)->paginate(20);
            $latest_news=$this->post->orderBy('created_at','desc')->where('publish',1)->take(8)->get();
            $trendings=$this->post->where('publish',1)->orderBy('view','desc')->take(8)->get();
            return view('front.trending',compact('posts','trend','latest_news','trendings'));
        }else{
            abort(404);
        }
    }
    public function unicode(){
        $latest_news=$this->post->orderBy('created_at','desc')->where('publish',1)->take(8)->get();
        $trendings=$this->post->where('publish',1)->orderBy('view','desc')->take(8)->get();
        return view('front.unicode',compact('latest_news','trendings'));
    }
    public function allVideos(){
        $videos=$this->video->all();
            $count=count($videos);
            $limit=$count-5;
            $latest_video1=$this->video->where('publish',1)->orderBy('created_at','desc')->take(1)->get();
            $latest_video2=$this->video->where('publish',1)->orderBy('created_at','desc')->skip(1)->take(4)->get();
            $videos=$this->video->where('publish',1)->orderBy('created_at','desc')->paginate(8);
            return view('front.allVideos',compact('videos','latest_video1','latest_video2'));
    }
    public function searchResult(Request $request){
        $this->validate($request,['q'=>'required']);
        $posts=$this->post->where('title', 'like', '%' . $request->q . '%')->paginate(20);
        $latest_news=$this->post->orderBy('created_at','desc')->where('publish',1)->take(8)->get();
        $trendings=$this->post->where('publish',1)->orderBy('view','desc')->take(8)->get();
        return view('front.searchResult',compact('posts','latest_news','trendings'));
    }
    public function page($slug){
        $page=$this->page->where('slug',$slug)->first();
        if($page){
            return view('front.page',compact('page'));
        }
        abort(404);
    }
}
