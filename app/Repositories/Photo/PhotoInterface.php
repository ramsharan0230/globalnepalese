<?php
namespace App\Repositories\Photo;
use App\Repositories\Crud\CrudInterface;
interface PhotoInterface extends CrudInterface{
	public function create($data);
	public function update($data,$id);
}