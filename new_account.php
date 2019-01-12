<?php
require 'models.php';

$account = new Bank_account($db);


$str = 'LV69RIXA';
for ($i=1; $i <=13; $i++) {
  $str = $str.rand(0,9);
}


$account['account_number']=$str;
$account['money']=0;
$account['client_id'] = $_SESSION['client_id'];
echo $account['client_id'];
var_dump($account);
$account->save();

header('location: main.php');
