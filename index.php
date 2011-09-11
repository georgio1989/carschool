<?php
session_start();
$_SESSION['login_fail']=(isset($_SESSION['login_fail']))?$_SESSION['login_fail']:0;
include './templates/header.html';
include 'sys/system.php';
include 'sys/functions.php';
include 'sys/secure.php';
include 'sys/config.php';
include 'sys/logger.php';
include 'sys/rooter.php';
$mod->megjelenit();
?>