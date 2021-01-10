<?php
namespace App\Repositories\Photo;
use App\Models\Photo;
use App\Repositories\Crud\CrudRepository;
class PhotoRepository extends CrudRepository implements PhotoInterface{
	public function __construct(Photo $photo){
		$this->model=$photo;
	}
	public function create($data){
		$this->model->create($data);
	}
	public function update($data,$id){
		$this->model->find($id)->update($data);
	}
}