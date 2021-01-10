<?php
namespace App\Repositories\Post;
use App\Models\Post;
use App\Models\CategoryPost;
use App\Repositories\Crud\CrudRepository;
class PostRepository extends CrudRepository implements PostInterface{
	public function __construct(Post $post,CategoryPost $category){
		$this->model=$post;
		$this->category=$category;
	}
	public function create($input){
		$value=$input;
		$year=date('Y');
		$month=date('m');
		$rand=rand();
		$value['slug']=$year.'-'.$month.'-'.$rand;
		$post=$this->model->create($value);	
		if($post){
			return $post->id;
		}
		return false;
	}
	public function update($data,$id){
		$post=$this->model->find($id);
		$value=$data;
		$this->model->find($id)->update($value);
	}
	public function savePivotTable($input){
		$this->category->create($input);
	}
	public function deletePivotTable($id){
		$this->category->where('post_id','=',$id)->delete();
	}
}
