<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Repositories\Post\PostRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Tag\TagRepository;
use Image;
use Auth;
use DB;

class PostController extends Controller
{
    private $post;
    private $category;
    public function __construct(PostRepository $post,CategoryRepository $category,TagRepository $tag){
        $this->post=$post;
        $this->tag=$tag;
        $this->category=$category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details=$this->post->orderBy('created_at','desc')->get();
        return view('admin.post.list',compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $today=Carbon::today();
        $categories=$this->category->get();
        $tags=$this->tag->all();
        return view('admin.post.create',compact('today','categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $message=['image.dimensions'=>'image must be less than 2500*1800'];
        $this->validate($request, $this->rules(),$message);
        $detail=$this->post->orderBy('order','desc')->first();
        $value=$request->except('image','publish', 'dateandtime');
        $value['publish']=is_null($request->publish)? 0 : 1 ;
        $value['main_news']=is_null($request->main_news)? 0 : 1 ;
        $value['banner1']=is_null($request->banner1)? 0 : 1 ;
        $value['banner2']=is_null($request->banner2)? 0 : 1 ;
        $value['feature']=is_null($request->feature)? 0 : 1 ;
        $value['edited_by']=Auth::user()->name;
        $value['dateandtime'] = $request->dateandtime ?? date('Y-m-d H:i');

        if($detail){
            $value['order']=$detail->order+1;
        }
        else{
            $value['order']=0;
        }
       // $value['description']=htmlentities($request->description);
        $value['view']=0 ;
        if($request->image){

            $image=$this->imageProcessing($request->file('image'));
            $mainimage=$request->image;
            
            
            $original_path = public_path()."/images/main";
            $mainimage->move($original_path,$image);
            $value['image']=$image;
        }
        if($request->reporter_image){
            $mainimage=$request->reporter_image;
            $imageName=time().'.'.$mainimage->getClientOriginalExtension();
            $original_path = public_path()."/images/reporter";
            $mainimage->move($original_path,$imageName);
            $value['reporter_image']=$imageName;
        }
        $id=$this->post->create($value);
        $this->savePivot($id,$request->category);
        

        return redirect()->route('news.index')->with('message','Post Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=$this->category->orderBy('created_at','desc')->get();
        $detail=$this->post->find($id);
        $tags=$this->tag->all();
        return view('admin.post.edit',compact('detail','categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $old=$this->post->find($id);
        $message=['image.dimensions'=>'image must be less than 2500*1800'];
        $sameSlugVal = $old->slug == $request->slug ? true : false;
        $this->validate($request, $this->rules($old->id,$sameSlugVal),$message);
        $value=$request->except('image','publish', 'dateandtime');
        $value['publish']=is_null($request->publish)? 0 : 1 ;
        $value['main_news']=is_null($request->main_news)? 0 : 1 ;
        $value['banner1']=is_null($request->banner1)? 0 : 1 ;
        $value['banner2']=is_null($request->banner2)? 0 : 1 ;
         $value['feature']=is_null($request->feature)? 0 : 1 ;
         $value['dateandtime'] = $request->dateandtime ?? date('Y-m-d H:i');
         //$value['edited_by']=Auth::user()->name;
        //$value['description']=htmlentities($request->description);
        if($request->image){
            $image=$this->post->find($id);
            if($image->image){
                $thumbPath = public_path('images/thumbnail');
                $mainPath = public_path('images/main');
                $sizePath = public_path('images/size');
                $listingPath = public_path('images/listing');
                if((file_exists($thumbPath.'/'.$image->image)) && (file_exists($listingPath.'/'.$image->image)) &&(file_exists($mainPath.'/'.$image->image)) &&(file_exists($sizePath.'/'.$image->image))){
                    unlink($thumbPath.'/'.$image->image);
                    unlink($mainPath.'/'.$image->image);
                    unlink($listingPath.'/'.$image->image);
                    unlink($sizePath.'/'.$image->image);
                }
            }
            $image=$this->imageProcessing($request->file('image'));
            $mainimage=$request->image;
            
            
            $original_path = public_path()."/images/main";
            $mainimage->move($original_path,$image);
            $value['image']=$image;
        }
        if($request->reporter_image){
            $mainimage=$request->reporter_image;
            $imageName=time().'.'.$mainimage->getClientOriginalExtension();
            $original_path = public_path()."/images/reporter";
            $mainimage->move($original_path,$imageName);
            $value['reporter_image']=$imageName;
        }
        $this->post->update($value,$id);
        $this->updatePivotTable($id, $request->category);
        return redirect()->route('news.index')->with('message','Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->role=='staff'){
            return redirect()->route('dashboard.index');
        }
        $image=$this->post->find($id);
        if($image->image){
            $thumbPath = public_path('images/thumbnail');
            $mainPath = public_path('images/main');
            $sizePath = public_path('images/size');
            $listingPath = public_path('images/listing');
            if((file_exists($thumbPath.'/'.$image->image))  && (file_exists($listingPath.'/'.$image->image)) &&(file_exists($mainPath.'/'.$image->image)) &&(file_exists($sizePath.'/'.$image->image)) ){
                unlink($thumbPath.'/'.$image->image);
                unlink($mainPath.'/'.$image->image);
                unlink($listingPath.'/'.$image->image);
                unlink($sizePath.'/'.$image->image);
            }
        }
        $this->post->destroy($id);
        return redirect()->back()->with('message','Post Deleted Successfully');
    }
    public function imageProcessing($image){
       $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
       $thumbPath = public_path('images/thumbnail');
       $mainPath = public_path('images/main');
       $sizePath = public_path('images/size');
       $listingPath = public_path('images/listing');
       $mediumPath = public_path('images/medium');
       $innerPath = public_path('images/inner');
       // $img = Image::make($image->getRealPath());
       // $img->fit(914, 577)->save($mainPath.'/'.$input['imagename']);
       
       $img1 = Image::make($image->getRealPath());
       $img1->fit(540, 299)->save($mediumPath.'/'.$input['imagename']);
       $img2 = Image::make($image->getRealPath());
       $img2->fit(121, 90)->save($listingPath.'/'.$input['imagename']);
       
       
      
       $destinationPath = public_path('/images');
       return $input['imagename'];     
    }
    public function rules($oldId = null, $sameSlugVal=false){

        $rules =  [
            'title' => 'required',
            'slug' => 'unique:posts|max:255',
            
            'category'=>'required',
            'image'=>'dimensions:max_width=2500,max_height=1800|max:1000',
            'reporter_image'=>'dimensions:max_width=250,max_height=250|max:1000'
            // 'date'=>'required'
            // 'meta_title' => 'required',
            // 'meta_description' => 'required',
        ];
        if($sameSlugVal){
            $rules['slug'] = 'unique:posts,slug,'.$oldId.'|max:255';
        }
        return $rules;
    }
    public function savePivot($postid,$category){
        for($i=0;$i<count($category);$i++){
            $input=['post_id'=>$postid,'category_id'=>$category[$i]];
            $this->post->savePivotTable($input);
        }
    }
    public function updatePivotTable($postId,$category){
        $this->post->deletePivotTable($postId);
        for ($i = 0; $i < count($category); $i++) {
            $input = array('post_id' => $postId, 'category_id' => $category[$i]);
            $this->post->savePivotTable($input);
        }
    }
    public function selectRelatedPost(Request $request){
        $program=$this->category->find($request->id);
        $details=$program->posts;
        return $details;
    }
    public function allImage(){
        $posts=$this->post->all();
        return view('admin.image.allImage',compact('posts'));
    }
    public function PostOrderChange(Request $request){

        $sections=DB::table('posts')->orderBy('order','ASC')->get();

        $itemID=$request->itemID;
        $itemIndex=$request->itemIndex;

        foreach($sections as $value){

            return DB::table('posts')->where('id','=',$itemID)->update(array('order'=>$itemIndex));
        }
    }
    public function removeImage(Request $request){
        $post=$this->post->findOrFail($request->id);
        if($request->type=="mainimage"){
            $post->image=null;
            $post->save();
            return "success";
        }else{
            $post->reporter_image=null;
            $post->save();
            return "reporter";
        }
        
    }
}

