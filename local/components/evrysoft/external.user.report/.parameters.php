<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

$arComponentParameters = array(
	'PARAMETERS' => array(
		'DATE_BEFORE' => [
			'NAME' => 'Вывод до',
			'TYPE' => 'DATE'
		],
		'DATE_AFTER' => [
			'NAME' => 'Вывод после',
			'TYPE' => 'DATE'
		],
		'DEBUG' => [
			'NAME' => 'Режим отладки',
			'TYPE' => 'CHECKBOX'
		],
		'LIMIT' => [
			'NAME' => 'Количество записей на странице',
			'TYPE' => 'STRING'
		],
		'USE_PRELOAD' => [
			'NAME' => 'Использовать preloader',
			'TYPE' => 'CHECKBOX'
		],
		'VIEW_TYPE' => [
			'NAME' => 'Режим вывода',
			'TYPE' => 'LIST',
			'VALUES' => [
				'FILE' => 'LIKE A FILE',
				'TABLE' => 'LIKE A TABLE',
				'BLOCK' => 'LIKE A BLOCK'
			],
			'PARENT' => 'BASE'
		]
	),
);
?>
