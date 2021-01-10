<?php
namespace App\Repositories\Tag;
use App\Repositories\Crud\CrudInterface;
interface TagInterface extends CrudInterface{
	public function create($input);
	public function update($data,$id);	
}