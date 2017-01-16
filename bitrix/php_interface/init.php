<?php 
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';


AddEventHandler('main', 'OnBeforeUserRegister', [EvrySoft\Handlers\OnBeforeUserRegister::class, 'externalRegister']);


// AddEventHandler('main', 'OnBeforeUserRegister', [EvrySoft\Handlers\])


AddEventHandler('main', 'OnAfterUserLogin', [EvrySoft\Handlers\OnAfterUserLogin::class, 'externalLogin']);




