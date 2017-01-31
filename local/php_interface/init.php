<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';


AddEventHandler('main', 'OnBeforeUserRegister', [EvrySoft\Handlers\Auth\OnBeforeUserRegister::class, 'beforeRegister']);

AddEventHandler('main', 'OnBeforeUserLogin', [EvrySoft\Handlers\Auth\OnBeforeUserLogin::class, 'beforeLogin']);

AddEventHandler('main', 'OnAfterUserLogin', [EvrySoft\Handlers\Auth\OnAfterUserLogin::class, 'afterLogin']);


AddEventHandler('main', 'OnBeforeProlog', [EvrySoft\Handlers\Page\OnBeforeProlog::class, 'OnBeforeProlog']);



