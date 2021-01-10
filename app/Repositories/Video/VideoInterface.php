<?php
namespace App\Repositories\Video;
use App\Repositories\Crud\CrudInterface;
interface VideoInterface extends CrudInterface{
	public function create($input);
	public function update($value,$id);
}