<?php
class overmij_model extends functions{

	public static function overmijfoto(){
		$getthis = array('page','title','content','style');
		$conditions = array('page' => 'overmij/foto');
		$data = Functions::select("content",$getthis,"`page` = :page",$conditions);
		return $data;
	}
	public static function overmijverhaal(){
		$getthis = array('page','title','content','style');
		$conditions = array('page' => 'overmij/story');
		$data = Functions::select("content",$getthis,"`page` = :page",$conditions);
		return $data;
	}
}
?>