<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\Team\TeamRepository;

class TeamController extends Controller
{
    public function __construct(TeamRepository $team){
        $this->team=$team;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details=$this->team->orderBy('created_at','desc')->get();
        return view('admin.team.list',compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['title'=>'required']);
        $value=$request->all();
        $value['publish']=is_null($request->publish)? 0 : 1 ;
        $this->team->create($value);
        return redirect()->route('team.index')->with('message','Team Added Successfully');
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
        $detail=$this->team->findOrFail($id);
        return view('admin.team.edit',compact('detail'));
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
        $this->validate($request,['title'=>'required']);
        $value=$request->all();
        $value['publish']=is_null($request->publish)? 0 : 1 ;
        
        $this->team->update($value,$id);
        return redirect()->route('team.index')->with('message','Team updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->team->destroy($id);
        return redirect()->back()->with('message','Team Deleted Successfully');
    }
}
