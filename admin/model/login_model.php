<?php
class login_model extends Functions{

	public static function form(){
		//little bit of a cheat
		if (controller::getURLValue(1,"short") == "Inloggen" && !empty($_SESSION['userid'])){
			header("Location: " . controller::Weblink() . "admin/Home/");
		}elseif (controller::getURLValue(2,"short") == "submit") {
			$requiredInput = array('username','password');
			$counter = 0;
			if (!empty($_POST['member']) && $_POST['member'] == "true") {
				setcookie("username",$_POST['username'], time() + (86400 * 5), "/"); // 86400 = 1 day
			}else{
				setcookie("username","",time() - 3600, "/");
			}
			foreach ($requiredInput as $key => $value) {
				$validate = $_POST[$value];
				if (empty($validate)) {
					controller::set_errorMessage("Please fill all fields ");
				}else{
					$counter++;
				}
			}
			if (count($requiredInput) == $counter){

				$values = array('ID','password','usertype');
				$conditions = array('username' => $_POST['username']);
				$data = Functions::select("users",$values, "`username` = :username", $conditions);
				if (!empty($data)) {
					$okeypass = password_verify($_POST['password'], $data[0]['password']);
					if ($okeypass === true) {
						//Everything is correct
						$_SESSION['userid'] = $data[0]['ID'];
						$_SESSION['usertype'] = $data[0]['usertype'];
						header("Location: " . controller::Weblink() . "admin/Home/");
					}else{
						//Password is wrong
						controller::set_errorMessage("The username/password is wrong");
						header("Location: " . controller::Weblink() . "admin/" . controller::getURLValue(1,"short"). "/");
					}
				}else{
					//Nothing found
					controller::set_errorMessage("The username/password is wrong");
					header("Location: " . controller::Weblink() . "admin/" . controller::getURLValue(1,"short"). "/");
				}
			}else{
				//Input are empty
				header("Location: " . controller::Weblink() . "admin/" . controller::getURLValue(1,"short"). "/");
			}
		}
	}
}
?>