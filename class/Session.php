<?php 

/**
 * Sessions in Class - Php
 */

class Session {


	/**
	 * Initialize sessions
	*/
	public static function init(){
		session_start();
	}

	/**
	 * Destroy sessions
	*/
	public static function destroy(){
		session_destroy();
	}


	public static function set($name, $value)
	{
		$_SESSION[$name] = $value;
	}

	public static function get($name) {
		return $_SESSION[$name];
	}

	public static function exist($name)
	{
		return isset($_SESSION[$name]);
	}

	public static function remove($name)
	{
		unset($_SESSION[$name]);
	}

	public static function once($name)
	{
		$vl = $_SESSION[$name];
		self::remove($name);
		return $vl;
	}


}


 ?>