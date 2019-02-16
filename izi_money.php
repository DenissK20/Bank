<?php

require 'models.php';

$_SESSION['ch'] = 0;
unset($_SESSION['t']);
unset($_SESSION['timer']);
unset($_SESSION['flag']);

if (!(isset($_SESSION['client_id']))) {
  header('location: index.php');
}

$_SESSION['flag2']=false;

$app = new \atk4\ui\App('Want to have easy money? :3');
$app->initLayout('Centered');

$button = $app->add(['Button', 'Play mini game!']);
$button->link(['mini_game']);

$_SESSION['one']=rand(0,99);
$_SESSION['two']=rand(0,99);

$button1 = $app->add(['Button', 'Back on main']);
$button1->link('main.php');

$button = $app->add(['Button', 'Play clicker game!']);
$button->link(['clicker_game']);
