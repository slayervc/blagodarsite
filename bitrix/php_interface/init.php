<?php 
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';


AddEventHandler('main', 'OnBeforeUserRegister', [EvrySoft\Handlers\OnBeforeUserRegister::class, 'externalRegister']);


AddEventHandler('main', 'OnBeforeUserLogin', [EvrySoft\Handlers\OnBeforeUserLogin::class, 'beforeLogin']);




