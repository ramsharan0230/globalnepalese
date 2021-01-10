<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Photo\PhotoRepository;
use Image;

class PhotoController extends Controller
{
    public function __construct(PhotoRepository $photo){
        $this->photo=$photo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details=$this->photo->orderBy('created_at','desc')->get();
        return view('admin.photo.list',compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.photo.create');
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
        $value=$request->except('image','publish');
        $value['publish']=is_null($request->publish)? 0 : 1 ;
       
        if($request->image){
            $image=$this->imageProcessing($request->file('image'));
            $value['image']=$image;
        }
        $this->photo->create($value);
        

        return redirect()->route('photo.index')->with('message','Image Added Successfully');
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
        $detail=$this->photo->find($id);
        return view('admin.photo.edit',compact('detail'));
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
        $value=$request->except('image','publish');
        $value['publish']=is_null($request->publish)? 0 : 1 ;
        
        if($request->image){
            // dd('helli');
            $image=$this->photo->find($id);
            if($image->image){
                
                $mainPath = public_path('images/main');
                $innerPath = public_path('images/inner');
                $listingPath = public_path('images/listing');
                if((file_exists($listingPath.'/'.$image->image)) &&(file_exists($mainPath.'/'.$image->image)) &&(file_exists($innerPath.'/'.$image->image))){
                    
                    unlink($mainPath.'/'.$image->image);
                    unlink($listingPath.'/'.$image->image);
                    unlink($innerPath.'/'.$image->image);
                }
            }
            $image=$this->imageProcessing($request->file('image'));
            $value['image']=$image;
        }
        $this->photo->update($value,$id);
        
        
        return redirect()->route('photo.index')->with('message','Image Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image=$this->photo->find($id);
            if($image->image){
                
                $mainPath = public_path('images/main');
                $innerPath = public_path('images/inner');
                $listingPath = public_path('images/listing');
                if((file_exists($listingPath.'/'.$image->image)) &&(file_exists($mainPath.'/'.$image->image)) &&(file_exists($innerPath.'/'.$image->image))){
                    
                    unlink($mainPath.'/'.$image->image);
                    unlink($listingPath.'/'.$image->image);
                    unlink($innerPath.'/'.$image->image);
                }
            }
        $this->photo->destroy($id);
        return redirect()->back()->with('message','Image Deleted Successfully');
    }
    public function imageProcessing($image){
       $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
      
       $mainPath = public_path('images/main');
      
       $listingPath = public_path('images/listing');
       
       $innerPath = public_path('images/inner');
       $img = Image::make($image->getRealPath());
       $img->fit(813, 756)->save($mainPath.'/'.$input['imagename']);
       
       $img1 = Image::make($image->getRealPath());
       $img1->fit(271, 252)->save($innerPath.'/'.$input['imagename']);
       $img2 = Image::make($image->getRealPath());
       $img2->fit(121, 90)->save($listingPath.'/'.$input['imagename']);
       
      
       $destinationPath = public_path('/images');
       return $input['imagename'];     
    }
    public function rules($oldId = null, $sameSlugVal=false){

        $rules =  [
            'title' => 'required',
            
            'image'=>'dimensions:max_width=2500,max_height=1800',
            // 'date'=>'required'
            // 'meta_title' => 'required',
            // 'meta_description' => 'required',
        ];
       
        return $rules;
    }
}
