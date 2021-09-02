<?php
include 'autoloader.php';
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo controller::getTitle(controller::getURLValue(2), "Name's Portfolio"); ?></title>
	<meta charset="utf-8">
	<?php controller::getMeta(); ?>
</head>
<body>
	<div class="side-menu">
		<?php
		controller::getHeader();

		controller::getPage(controller::getURLValue(2),true);
		?>
	</div>
<?php
controller::getFooter();
?>
</body>
</html>