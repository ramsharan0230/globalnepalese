<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Advert\AdvertRepository;
use Image;

class AdvertisementController extends Controller
{
    public $sections = array(
            'Home header'=>'Home Page header',
            'Below main photo news'=>'Below main photo news',
            'Above feature'=>'Above Feature',
            'Above sahitya'=>'Above Sahitya',
            'Above khelkud'=>'Above khelkud',
            'Above Multimedia'=>'Above Multimedia',
            'Above Dristikon'=>'Above Dristikon',
            'Above main title inner page'=>'Above main title inner page',
            'Below news content'=>'Below news content',
            'Below Lokpriya and taja'=>'Below Lokpriya and taja',
            
            
        );
    public function __construct(AdvertRepository $advert){
        $this->advert=$advert;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details=$this->advert->orderBy('created_at','desc')->get();
        
        return view('admin.advert.list',compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = $this->sections;
        return view('admin.advert.create',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['title'=>'required','image'=>'required','sections'=>'required']);
        $value=$request->except('section','image');
        $value['publish']=is_null($request->publish)?0:1;
        if($request->image){
            $mainimage=$request->image;
            $imageName=time().'.'.$mainimage->getClientOriginalExtension();
            $original_path = public_path()."/images/";
            $mainimage->move($original_path,$imageName);
            $value['image']=$imageName;
        }
        $value['sections'] ='';
        
        if($request->sections){
            $accesses = $request->get('sections');
            foreach($accesses as $access){
                        $value['sections'] .= ($value['sections']==""?"":",").$access;
                    }
            
        }

        $this->advert->create($value);
        return redirect()->route('advert.index')->with('message','Advertisement Added Successfully');

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
        $section_options = $this->sections;
       
        $detail=$this->advert->find($id);     
        $selected = ($detail->sections)?explode(",",$detail->sections):array();

        return view('admin.advert.edit',compact('detail','section_options','selected'));
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
        $this->validate($request,['title'=>'required','sections'=>'required']);
        $value=$request->except('section','image');
        $value['publish']=is_null($request->publish)?0:1;
        if($request->image){
            $mainimage=$request->image;
            $imageName=time().'.'.$mainimage->getClientOriginalExtension();
            $original_path = public_path()."/images/";
            $mainimage->move($original_path,$imageName);
            $value['image']=$imageName;
        }
        $value['sections'] ='';
        
        if($request->sections){
            $accesses = $request->get('sections');
            foreach($accesses as $access){
                        $value['sections'] .= ($value['sections']==""?"":",").$access;
                    }
            
        }

        $this->advert->update($value,$id);
        return redirect()->route('advert.index')->with('message','Advertisement Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->advert->destroy($id);
        return redirect()->back()->with('message','Advertisement Deleted Successfully');
    }
}
