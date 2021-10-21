<?php
class projecten_model extends Functions{

	public static function getprojects(){
		$getthis = array('ID','name','imagename');
		$projects = Functions::select("projects",$getthis);
		return $projects;
	}
	public static function getviewproject($project){
		$getthis = array('name','description','imagename');
		$conditions = array('ID' => $project);
		$projects = Functions::select("projects",$getthis,"`ID` = :ID",$conditions);
		return $projects;
	}
}
?>