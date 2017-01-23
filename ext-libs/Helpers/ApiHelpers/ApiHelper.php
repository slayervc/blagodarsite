<?php 

namespace EvrySoft\Helpers\ApiHelpers;

/**
* 
*/
class ApiHelper
{
	
	/**
	 * [MakeHiddenArray description]
	 * @param array $dataArray [description]
	 * @param array $hideArray [description]
	 * 
	 * @return array 
	 */
	public static function makeHiddenArray(array $dataArray, array $hideArray)
	{

		$hiddenArray = [];

		foreach ($hideArray as $hiddenParam) {
			foreach ($dataArray as $arrKey => $arrValue) {
				if (array_key_exists($hiddenParam, $arrValue)) {
					$hiddenArray[$arrKey][$hiddenParam] = $arrValue[$hiddenParam];
				}
			}
		}

		return $hiddenArray;
	}
	

	/**
	 * [clearFromArray description]
	 * @param  array  $sourceArr
	 * @param  array  $diffArr
	 * @return array
	 */
	public static function clearFromArray(array $sourceArr, array $diffArr)
	{

		$clearArr = [];

		foreach ($sourceArr as $arrKey => $arrValue) {
			$clearArr[$arrKey] = array_diff($arrValue, $diffArr[$arrKey]);
		}

		return $clearArr;
	}


}
