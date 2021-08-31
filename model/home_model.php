<?php

/**
 * 
 */
class home_model extends functions{

	public function getName(){
		return "i'm a model :)";
	}
	public function form(){
		if (controller::getURLValue(3) == "submit") {
			$value = $_POST['cheese'];
			$_SESSION['tel'] += 1;
			echo " - $value - ";
			header("location: ./");
		}
		echo "". $_SESSION['tel'];
	}
}



?>