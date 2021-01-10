<?php
namespace App\Repositories\Video;
use App\Models\Video;
use App\Repositories\Crud\CrudRepository;
class VideoRepository extends CrudRepository implements VideoInterface{
	public function __construct(Video $video){
		$this->model=$video;
	}
	public function create($input){
		$this->model->create($input);
	}
	public function update($value,$id){
		$this->model->find($id)->update($value);
	}
}