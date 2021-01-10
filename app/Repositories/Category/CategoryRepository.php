<?php
namespace App\Repositories\Category;
use App\Models\Category;
use App\Models\Post;
use App\Repositories\Crud\CrudRepository;
class CategoryRepository extends CrudRepository implements CategoryInterface{
	public function __construct(Category $category,Post $post){
		$this->model=$category;
		$this->post=$post;
	}
	public function create($input){
		$value=$input;
		$value['slug']=!empty($input['slug'])? str_slug($input['slug']) : str_slug($input['title']);
		$this->model->create($value);
	}
	public function update($data,$id){
		$category=$this->model->find($id);
		$value=$data;
		if($value['slug']!==$category['slug']){
			$value['slug']=str_slug($data['slug']);
		}
		$this->model->find($id)->update($value);
	}
	public function changestatus($id,$status){
		$page=$this->post->find($id);
		$page->publish=$status;
		$page->save();
		return $page;
	}
}