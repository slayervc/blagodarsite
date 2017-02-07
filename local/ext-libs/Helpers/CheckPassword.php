<?php 

namespace EvrySoft\Helpers;




/**
*	Check indent password in database for CUser
*
* 
*/
class CheckPassword
{
	

	/**
	 * Check password from User login and password
	 * @param  string $login    any login
	 * @param  string $password password not md5 hash
	 * @return boolean
	 */
	public static function checkByLogin($login, $password)
	{
		$userData = \CUser::GetByLogin($login)->Fetch();

		$salt = substr($userData['PASSWORD'], 0, (strlen($userData['PASSWORD']) - 32));

		$realPassword = substr($userData['PASSWORD'], -32);
		$password = md5($salt.$password);

		return ($password == $realPassword);
	}
}

