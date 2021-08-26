<?php
$db['database'] = "portfolio";
$db['user'] = "root";
$db['password'] = "";
$db['server'] = "localhost";

Functions::getConnectionToDatabase($db['server'],$db['user'],$db['password'],$db['database']);

controller::setpath(__DIR__);

?>