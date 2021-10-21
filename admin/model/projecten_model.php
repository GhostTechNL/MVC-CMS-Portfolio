<?php
class projecten_model extends Functions{

	public static function get_projects(){
		$getthis = array('ID','name','imagename');
		$data = Functions::select("projects",$getthis);
		return $data;
	}
	public static function the_project($id){
		$getthis = array('ID','name','description','imagename');
		$conditions = array('ID' => $id);
		$data = Functions::select("projects",$getthis,"`ID` = :ID",$conditions);
		return $data[0];
	}
	public static function Update(){
		if (controller::getURLValue(4,"short") == "submit") {
			$requiredInput = array('name');
			$counter = 0;
			foreach ($requiredInput as $key => $value) {
				$validate = $_POST[$value];
				if (empty($validate)) {
					controller::set_errorMessage("Please fill all fields ");
				}else{
					$counter++;
				}
			}
			if (count($requiredInput) == $counter){
				//Everything is filled
				$data = false;
				$is_file_ok = 0;
				$newname = date("dY");
				$filetype = strtolower(pathinfo($_FILES['image']['type'], PATHINFO_BASENAME));
				if (empty($filetype)) {
					//None image has been upload.
					$insertvalue = array('name' => $_POST['name'],'description' => $_POST['description']);
					$conditions = array('ID' => controller::getURLValue(3,"short"));
					$data = Functions::simpleQuery("update",'projects',$insertvalue, "`ID` = :ID", $conditions);
					if ($data == true) {
						controller::set_noteMessage("Project is succesfuly Updated.");
						header("Location: " . controller::Weblink() . "admin/" . controller::getURLValue(1,"short"). "/");
					}else{
						controller::set_errorMessage("Failed to save. Try it later again");
						header("Location: " . controller::Weblink() . "admin/" . controller::getURLValue(1,"short"). "/" . controller::getURLValue(2,"short") . "/" . controller::getURLValue(3,"short") . "/");
					}
				}else{
					//Image not empty
					if ($filetype == "jpg" || $filetype == "png" || $filetype == "svg") {
						$is_file_ok++;
					}else{
						controller::set_errorMessage("Only jpg/png/svg format allowed");
					}
					if ($is_file_ok == 1) {
						$length = 8;
						for ($i=0; $i <= $length; $i++) {
							$newname .= rand(0,9);
							if ($i == $length) {
								$_FILES['image']['name'] = $newname . ".". $filetype;
							}
						}
					}
					if (!empty($filetype) && $is_file_ok == 1)  {
						$insertvalue = array('name' => $_POST['name'],'description' => $_POST['description'],'imagename' => $_FILES['image']['name']);
						$conditions = array('ID' => controller::getURLValue(3,"short"));
						$data = Functions::simpleQuery("update",'projects',$insertvalue, "`ID` = :ID", $conditions);
					}else{
						header("Location: " . controller::Weblink() . "admin/" . controller::getURLValue(1,"short"). "/");
					}
					if ($data == true) {
						$is_file_ok++;
						if ($is_file_ok == 2) {
							$upload_dir = controller::getpath() . "/content/assets/upload/" . $_FILES['image']['name'];
							if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir)) {
								controller::set_noteMessage("Project is succesfuly Updated");
								header("Location: " . controller::Weblink() . "admin/" . controller::getURLValue(1,"short"). "/" . controller::getURLValue(2,"short") . "/");
							}else{
								controller::set_errorMessage("Image failed to upload. Try it again");
								header("Location: " . controller::Weblink() . "admin/" . controller::getURLValue(1,"short"). "/" . controller::getURLValue(2,"short") . "/" . controller::getURLValue(3,"short") . "/");
							}
						}
					}else{
						controller::set_errorMessage("Failed to save. Try it later again");
					}
				}
			}else{
				//Input are empty
				header("Location: " . controller::Weblink() . "admin/" . controller::getURLValue(1,"short"). "/" . controller::getURLValue(2,"short") . "/" . controller::getURLValue(3,"short") . "/");
			}
			header("Location: " . controller::Weblink() . "admin/" . controller::getURLValue(1,"short"). "/" . controller::getURLValue(2,"short") . "/" . controller::getURLValue(3,"short") . "/");
		}
	}
	public static function Create(){
		if (controller::getURLValue(3,"short") == "submit") {
			$requiredInput = array('name');
			$counter = 0;
			foreach ($requiredInput as $key => $value) {
				$validate = $_POST[$value];
				if (empty($validate)) {
					controller::set_errorMessage("Please fill all fields ");
				}else{
					$counter++;
				}
			}
			if (count($requiredInput) == $counter){
				//Everything is filled
				$is_file_ok = 0;
				$newname = date("dY");
				$filetype = strtolower(pathinfo($_FILES['image']['type'], PATHINFO_BASENAME));
				if (empty($filetype)) {
					$insertvalue = array('name' => $_POST['name'],'description' => $_POST['description']);
					$data = Functions::simpleQuery("insert",'projects',$insertvalue);
					if ($data == true) {
						controller::set_noteMessage("Project is succesfuly uploaded");
						header("Location: " . controller::Weblink() . "admin/" . controller::getURLValue(1,"short"). "/");
					}else{
						controller::set_errorMessage("Failed to save. Try it later again");
					}
				}else{
					//Image not empty
					if ($filetype == "jpg" || $filetype == "png" || $filetype == "svg" || $filetype == "jpeg") {
						$is_file_ok++;
					}else{
						controller::set_errorMessage("Only jpg/png/svg format allowed");
					}
					if (!empty($_FILES['image']['name'] && $is_file_ok == 1)) {
						$length = 8;
						for ($i=0; $i <= $length; $i++) {
							$newname .= rand(0,9);
							if ($i == $length) {
								$_FILES['image']['name'] = $newname . ".". $filetype;
							}
						}
					}
					if (!empty($filetype) && $is_file_ok == 1)  {
						$insertvalue = array('name' => $_POST['name'],'description' => $_POST['description'],'imagename' => $_FILES['image']['name']);
						$data = Functions::simpleQuery("insert",'projects',$insertvalue);
					}else{
						header("Location: " . controller::Weblink() . "admin/" . controller::getURLValue(1,"short"). "/" . controller::getURLValue(2,"short") . "/");
						die();
					}
					if ($data == true) {
						$is_file_ok++;
						if ($is_file_ok == 2) {
							$upload_dir = controller::getpath() . "/content/assets/upload/" . $_FILES['image']['name'];
							if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir)) {
								controller::set_noteMessage("Project is succesfuly uploaded");
								header("Location: " . controller::Weblink() . "admin/" . controller::getURLValue(1,"short"). "/");
							}else{
								controller::set_errorMessage("Image failed to upload. Try it again");
							}
						}
					}else{
						controller::set_errorMessage("Failed to save. Try it later again");
					}
				}
			}else{
				//Input are empty
				header("Location: " . controller::Weblink() . "admin/" . controller::getURLValue(1,"short"). "/" . controller::getURLValue(2,"short") . "/");
			}
			header("Location: " . controller::Weblink() . "admin/" . controller::getURLValue(1,"short"). "/" . controller::getURLValue(2,"short") . "/");
		}
	}

	public static function Delete(){
		if (controller::getURLValue(2,"short") == "Delete" && controller::getURLValue(3,"short") !== "" && controller::getURLValue(4,"short") == "submit") {
			$conditions = array("ID" => controller::getURLValue(3,"short"));
			$data = Functions::simpleQuery("delete","projects",null,"`ID` = :ID",$conditions);
			if ($data == true) {
				controller::set_noteMessage("Project is succesfuly deleted");
			}else{
				controller::set_errorMessage("Failed to delete! Try it later again");
			}
			header("Location: " . controller::Weblink() . "admin/" . controller::getURLValue(1,"short"). "/");
		}
	}
}
?>