<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Video\VideoRepository;

class VideoController extends Controller
{
    private $video;
    public function __construct(VideoRepository $video){
        $this->video=$video;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details=$this->video->orderBy('created_at','desc')->get();
        return view('admin.video.list',compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $rules=['link'=>'required'];
        $this->validate($request,$rules);
        $value=$request->except('publish');
        $value['publish']=is_null($request->publish)? 0 : 1 ;
        $this->video->create($value);
        return redirect()->route('video.index')->with('message','Video added successfully');

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
        $detail=$this->video->find($id);
        return view('admin.video.edit',compact('detail'));
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
        $rules=['link'=>'required'];
        $this->validate($request,$rules);
        $value=$request->except('publish');
        $value['publish']=is_null($request->publish)? 0 : 1 ;
        $this->video->update($value,$id);
        return redirect()->route('video.index')->with('message','Video added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->video->destroy($id);
        return redirect()->back()->with('message','Video Link Deleted Successfully');
    }
}
