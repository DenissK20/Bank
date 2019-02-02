<?php

require 'models.php';

if (!(isset($_SESSION['client_id']))) {
  header('location: index.php');
}

$app = new \atk4\ui\App('Welcome to our clicker game, where you can earn easy money!');
$app->initLayout('Centered');

if(!isset($_SESSION['timer'])){
  $_SESSION['timer'] = time();
}

$now = time();

$_SESSION['t'] = $now - $_SESSION['timer'];

$button2 = $app->add(['Button']);

$button->on('click', function($action){
  $_SESSION['ch'] = $_SESSION['ch']+1;
  return $action->text($_SESSION['t']);
});

$button = $app->add(['Button','Click!', 'massive']);
$button->on('click', function($action){
  $_SESSION['ch'] = $_SESSION['ch']+1;
  return $action->text($_SESSION['ch']);
});

$button1 = $app->add(['Button', 'Back on main']);
$button1->link('main.php');
