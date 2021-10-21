<?php
class skills_model extends Functions{

	public static function skillstory(){
		$getthis = array('page','title','content','style');
		$conditions = array('page' => 'skills/story');
		$data = Functions::select("content",$getthis,"`page` = :page",$conditions);
		return $data;
	}
	public static function skillmeter(){
		$getthis = array('page','title','content','style');
		$conditions = array('page' => 'skills/meter');
		$data = Functions::select("content",$getthis,"`page` = :page ORDER BY `content` DESC",$conditions);
		return $data;
	}
}
?>