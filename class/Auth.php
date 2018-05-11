<?php

class Auth
{
	/**
	 * Access user verify password
	 * @param  [email]
	 * @param  [password]
	 * @return [boolean]
	 */
	public static function login($email, $password)
	{
		$user = User::getByUser($email, $password);
		if($user !== null) {
			//Verify encrypt md5 iquals user password
			if (md5($password) === $user->password) {
				//Save session set id
				Session::set('id', $user->id_user);	
				//Success continue
				return true;
				
			} else {

				return false;
			}

		}
		return false;
	}

	
}