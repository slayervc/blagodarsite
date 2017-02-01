<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

$apiFieldsAllowedForHiding = [
	'transaction' => 'transaction', 
	'operation_code' => 'operation_code', 
	'sum_minus_partner' => 'sum_minus_partner', 
	'sum_comission_partner' => 'sum_comission_partner', 
	'sum_plus_partner' => 'sum_plus_partner'
];


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
				'FILE' => 'Ссылка на файл',
				'TABLE' => 'Как таблица',
				'BLOCK' => 'Как блоки'
			],
			'PARENT' => 'BASE'
		],
		'DONT_SHOW' => [
			'NAME' => 'Скрывать значения вывода',
			'TYPE' => 'LIST',
			'MULTIPLE' => 'Y',
			'VALUES' => $apiFieldsAllowedForHiding,
			'DEFAULT' => []	
		]
	),
);
?>
