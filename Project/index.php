<?php
include 'autoloader.php';
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<? controller::getMeta(); ?>
</head>
<body>
<?php
controller::getHeader();

controller::getPage($_GET['page'],true);

controller::getFooter();
?>
</body>
</html>