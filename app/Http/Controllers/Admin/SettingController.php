<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Setting\SettingRepository;

class SettingController extends Controller
{
    public function __construct(SettingRepository $setting){
        $this->setting=$setting;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detail=$this->setting->first();
        return view('admin.setting.create',compact('detail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        $this->validate($request,['meta_title'=>'max:250','num_banner_1'=>'integer|min:0','num_banner_2'=>'integer|min:0']);
        $data=$request->except('logo','fav_icon');
        if($request->fav_icon){
            $image=$request->file('fav_icon');
            $imageName = time().'.favicom.'.$image->getClientOriginalExtension();

            $image->move(public_path('images/thumbnail'),$imageName);
            $data['fav_icon']=$imageName;
        }
        if($request->logo){
            $logo=$request->file('logo');
            $imageName = time().'.logo.'.$logo->getClientOriginalExtension();
            $logo->move(public_path('images/thumbnail'),$imageName);
            $data['logo']=$imageName;
        }
        if($request->footer_logo){
            $logo=$request->file('footer_logo');
            $imageName = time().'.footerlogo.'.$logo->getClientOriginalExtension();
            $logo->move(public_path('images/thumbnail'),$imageName);
            $data['footer_logo']=$imageName;
        }
        $this->setting->update($data,$id);
        return redirect()->back()->with('message','Setting Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
