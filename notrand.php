<?php

session_start();

$_SESSION['client_id'] = $_GET['client_id'];
header('Location:main.php');
