<?php 
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';


AddEventHandler('main', 'OnBeforeUserRegister', [EvrySoft\Handlers\OnBeforeUserRegister::class, 'dump']);




