<?php
if(!defined("B_PROLOG_INCLUDED")|| B_PROLOG_INCLUDED !== true)die();

$arComponentParameters = array(
	'PARAMETERS' => array(
		'DONT_SHOW' => [
			'NAME' => 'Какие параметры не показывать',
			'TYPE' => 'LIST',
			'MULTIPLE' => 'Y',
			'VALUES' => [
				'LEVEL' => 'LEVEL',
				'BLOCKED' => 'BLOCKED',
				'ID' => 'ID'
			],
			'PARENT' => 'BASE'
		],
		'DEBUG' => [
			'NAME' => 'DEBUG',
			'TYPE' => 'CHECKBOX',
		]
	),
);
?>
