<?php
namespace App\Repositories\Advert;
use App\Repositories\Crud\CrudInterface;
interface AdvertInterface extends CrudInterface{
	public function create($data);
}