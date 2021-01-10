<?php
namespace App\Repositories\Post;
use App\Repositories\Crud\CrudInterface;
interface PostInterface extends CrudInterface{
	public function create($input);
	public function update($data,$id);
	public function savePivotTable($input);
	public function deletePivotTable($id);
}