<?php

use App\Payment\Payme;

require_once './src/constants.php';
require_once './vendor/autoload.php';


$payme = new Payme();

echo $payme->create();



