<?php 
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';


AddEventHandler('main', 'OnBeforeUserRegister', [EvrySoft\Handlers\OnBeforeUserRegister::class, 'beforeRegister']);

AddEventHandler('main', 'OnAfterUserRegister', [EvrySoft\Handlers\OnAfterUserRegister::class, 'afterRegister']);

AddEventHandler('main', 'OnBeforeUserLogin', [EvrySoft\Handlers\OnBeforeUserLogin::class, 'beforeLogin']);




