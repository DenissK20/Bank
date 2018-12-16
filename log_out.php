<?php

session_start();
unset($_SESSION['client_id']);
unset($_SESSION['hach']);

header('location: index.php');
