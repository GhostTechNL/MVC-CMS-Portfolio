<?php
include 'autoloader.php';
include 'config.php';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
	<title><?php echo controller::getTitle(controller::getURLValue(1,"short"), "Tyno's Portfolio"); ?></title>
	<?php controller::getMeta(); ?>
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
</html>