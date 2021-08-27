<?php
include 'autoloader.php';
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo controller::getTitle($_GET['page'], "name's Portfolio"); ?></title>
	<meta charset="utf-8">
	<?php controller::getMeta(); ?>
</head>
<body>
<?php
controller::getHeader();

controller::getPage($_GET['page'],true);

controller::getFooter();
?>
</body>
</html>