<?php
//Load files with classes
spl_autoload_register(function($class){
	if (file_exists(__DIR__ . '/controller/' . $class . '.php')) {
		include __DIR__ . '/controller/' . $class . '.php';
	}elseif (file_exists(__DIR__ . '/classes/' . $class . '.php')) {
		include __DIR__ . '/classes/' . $class . '.php';
	}
});
?>