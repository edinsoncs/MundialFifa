<?php 


class User {

	/**
	 * Create new user
	 * @param  [$fields]
	 * @return [user]
	 */
	public static function created($field) {

		//Connect database
		$database = Database::getConnect();
		//INser new user
		$q = "INSERT INTO user (email, name, password, status)
		VALUES (:email, :name, :pwd, :st) ";
		$stmt = $database->prepare($q);
		$success = $stmt->execute([
			'email' => $field['email'],
			'name' => $field['username'],
			'pwd' => md5($field['password']),
			'st' => 0
		]);
		
		if(!$success) {
			//print_r($stmt->errorInfo());
			throw new Exception("Error al crear el usuario");
		}

		//Return new user success
		$user = new User;
		$user->id_user 	= $database->lastInsertId();
		$user->email 	= $data['email'];
		$user->password = $data['password'];

		Session::set('__exist_email', 'El email ya existe');

		return $user;

	} 

	/**
	 * Find by user 	
	 * @param  [$email]
	 * @param  [$pwd]
	 * @return [user]
	 */
	public static function getByUser($email, $pwd){

		$db = Database::getConnect();
		$query = "SELECT * FROM user
				WHERE email = :email";
		$stmt = $db->prepare($query);
		$stmt->execute([
			'email' => $email,
		]);


		if($fl = $stmt->fetch(PDO::FETCH_ASSOC)) {

			$user = new User;
			$user->id_user 	= $fl['id'];
			$user->email 	= $fl['email'];
			$user->name 	= $fl['name'];
 			$user->password = $fl['password'];
			
			return $user;
			
		} else {

			return null;
		
		}

	} 


	/**
	 * Verify status user
	 * @return [boolean]
	 */
	public static function verifyStatus(){
		
		$database = Database::getConnect();
		$q = "SELECT * FROM user WHERE id = :id";
		$stmt = $database->prepare($q);
		$success = $stmt->execute([
			'id' => Session::get('id')
		]);

		if($fl = $stmt->fetch(PDO::FETCH_ASSOC)) {

			$user = new User;
			$user->status 	= $fl['status'];

			if($fl['status']) {
				return true;
			} else {
				return false;
			}

		}

	}


	/**
	 * Get avatar user
	 * @return [boolean]
	 */
	public static function getAtavar() {

		$database = Database::getConnect();
		$q = "SELECT * FROM files WHERE user = :id";
		$stmt = $database->prepare($q);
		$success = $stmt->execute([
			'id' => Session::get('id')
		]);

		if($fl = $stmt->fetch(PDO::FETCH_ASSOC)) {

			$file = new Files;
			$file->id = $fl['id'];
			$file->name = $fl['name'];

			if($file) {
				return $file;

			} else {
				return false;
			}


		}

	}

	/**
	 * Get user
	 * @return [boolean]
	 */
	public static function getUser() {

		$database = Database::getConnect();
		$q = "SELECT * FROM user WHERE id = :id";
		$stmt = $database->prepare($q);
		$success = $stmt->execute([
			'id' => Session::get('id')
		]);

		if($fl = $stmt->fetch(PDO::FETCH_ASSOC)) {

			$user = new User;
			$user->name = $fl['name'];
			$user->id = $fl['id'];
			$user->email = $fl['email'];

			if($user) {
				return $user;

			} else {
				return false;
			}


		}

	}

}


?>