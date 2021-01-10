<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepository;
use DB;
class CategoryController extends Controller
{
    private $category;
    public function __construct(CategoryRepository $category){
        $this->category=$category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details=$this->category->orderBy('order','asc')->get();
        return view('admin.category.list',compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        $value=$request->except('publish');
        $value['publish']=is_null($request->publish)? 0 : 1 ;
        $value['header']=0;
        $value['main']=0;
        $this->category->create($value);
        return redirect()->route('category.index')->with('message','Category Deleted Successfully');
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
        $detail=$this->category->find($id);
        return view('admin.category.edit',compact('detail'));
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
        $old=$this->category->find($id);
        $sameSlugVal = $old->slug == $request->slug ? true : false;
        $this->validate($request, $this->rules($old->id,$sameSlugVal));
        $value=$request->except('publish');
        $value['publish']=is_null($request->publish)? 0 : 1 ;
        $value['header']=0;
        $value['main']=0;
        $this->category->update($value,$id);
        return redirect()->route('category.index')->with('message','Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->category->destroy($id);
        return redirect()->back()->with('message','Category Deleted Successfully');
    }
    public function rules($oldId = null, $sameSlugVal=false){

        $rules =  [
            'title' => 'required',
        ];
        if($sameSlugVal){
            $rules['slug'] = 'unique:categories,slug,'.$oldId.'|max:255';
        }
        return $rules;
    }
     public function changeStatus(Request $request){

        $post=$this->category->changestatus($request->id,$request->status);
        
        return "success";
    }
    public function categorysortable(Request $request){
        $category=DB::table('categories')->orderBy('order','ASC')->get();
        $itemID=$request->itemID;
        $itemIndex=$request->itemIndex;
        $itemIndex;
        foreach($category as $value){
            return DB::table('categories')->where('id','=',$itemID)->update(array('order'=>$itemIndex));
        }
    }
}
