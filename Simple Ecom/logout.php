<?php
require_once("Connect.php");

unset($_SESSION['user']);
header('Location: userProductView.php');

?>