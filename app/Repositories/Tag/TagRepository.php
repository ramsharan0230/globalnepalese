<?php
namespace App\Repositories\Tag;
use App\Repositories\Crud\CrudRepository;
use App\Models\Tag;
class TagRepository extends CrudRepository implements TagInterface{
	public function __construct(Tag $tag){
		$this->model=$tag;
	}
	public function create($input){
		// $value=$input;
		// $year=date('Y');
		// $month=date('m');
		// $rand=rand();
		// $value['slug']=str_slug($value['title']);
		$post=$this->model->create($input);	
		if($post){
			return $post->id;
		}
		return false;
	}
	public function update($data,$id){
		$this->model->find($id)->update($data);
	}
}