<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Tag\TagRepository;

class TagController extends Controller
{
    public function __construct(TagRepository $tag){
        $this->tag=$tag;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details=$this->tag->orderBy('created_at','desc')->get();
        return view('admin.tag.list',compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['title'=>'required','slug'=>'required']);

        $value=$request->all();
        $value['publish']=is_null($request->publish)? 0 : 1 ;
        $this->tag->create($value);
        return redirect()->route('tag.index')->with('message','Tag Added Successfully');
        
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
        $detail=$this->tag->findOrFail($id);
        return view('admin.tag.edit',compact('detail'));
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
        $this->validate($request,['title'=>'required','slug'=>'required']);

        $value=$request->all();
        $value['publish']=is_null($request->publish)? 0 : 1 ;
        $this->tag->update($value,$id);
        return redirect()->route('tag.index')->with('message','Tag updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->tag->destroy($id);
        return redirect()->back()->with('message','Tag Deleted Successfully');
    }
}
