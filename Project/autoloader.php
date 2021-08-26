<?php
//Load files with classes
spl_autoload_register(function($class){
	include __DIR__ . '/controller/' . $class . '.php';
});
?>