<?php
session_start();
require_once 'class.user.php';
$user = new USER();


$user->logout();
$user->redirect('../logged-out.html');

?>
