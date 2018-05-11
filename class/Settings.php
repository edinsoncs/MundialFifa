<?php 



class Settings {

	/**
	 * Post or get
	 * @return [boolean]
	 */
	public static function getPost() {
		if($_POST) {
			return true;
		} else {
			return false;
		}
	}


}


 ?>