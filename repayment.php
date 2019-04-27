<?php

require 'models.php';

if (!(isset($_SESSION['client_id']))) {
  header('location: index.php');
}

$app = new \atk4\ui\App('Loan repayment');
$app->initLayout('Centered');
