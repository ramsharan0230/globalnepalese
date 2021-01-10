<?php
namespace App\Repositories\Advert;
use App\Models\Advert;
use App\Repositories\Crud\CrudRepository;
class AdvertRepository extends CrudRepository implements AdvertInterface{
	public function __construct(Advert $advert){
		$this->model=$advert;
		
	}
	public function create($data){
		$this->model->create($data);
	}
	public function update($data,$id){
		$this->model->find($id)->update($data);
	}
	
	
}