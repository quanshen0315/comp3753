<?php
session_start();
include('header.php');
if(!isset($_SESSION["user"]))
    header('Location: /login.php');

?>
