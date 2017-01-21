<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Config\Configuration;

	// USER data from authorized request
	$userData = $USER->GetParam('USER_EXT_INFO');

	if (!$USER->IsAdmin()){
		$arResult['EXT_REQUEST_STATUS'] = $userData['status'];
		$arResult['USER_ALL_DATA'] = array_change_key_case($userData['info'], CASE_UPPER);
		$arResult['USER_SHOW_DATA'] = [];
		$arResult['USER_HIDDEN_DATA'] = [];

		foreach ($arParams['DONT_SHOW'] as $hideParam) {
			$param = strtolower($hideParam);
			if (array_key_exists($param, $userData['info'])) {
				$arResult['USER_HIDDEN_DATA'][$hideParam] = $userData['info'][$param];
			}
		}

		$arResult['USER_SHOW_DATA'] = array_diff($arResult['USER_ALL_DATA'], $arResult['USER_HIDDEN_DATA']);

	}

	$this->IncludeComponentTemplate();
?>
