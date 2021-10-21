<?php
//This is the admin index
include '../autoloader.php';
include '../config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo controller::getTitle(controller::getURLValue(1,"short"), "Tyno's Portfolio"); ?></title>
	<?php controller::getMeta(); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo controller::Weblink(); ?>admin/css/style.css?v=1">
</head>
<body>
	<div class="side-menu">
	<?php
		controller::getHeader();
		
		controller::getPage(controller::getURLValue(1,"short"),true);
		
		?>
	</div>
	<?php
		controller::getFooter();
	?>
</body>
<html>