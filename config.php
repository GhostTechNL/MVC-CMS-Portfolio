<?php
session_start();

$db['database'] = "portfolio";
$db['user'] = "root";
$db['password'] = "";
$db['server'] = "localhost";

Functions::getConnectionToDatabase($db['server'],$db['user'],$db['password'],$db['database']);

controller::setpath(__DIR__);

controller::Weblink("https://localhost/MVC-CMS-Portfolio/");

//controller::maintenancemode();

?>