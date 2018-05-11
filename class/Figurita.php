<?php 


class Figurita {



	/**
	 * Create figurita
	 * @param  [field]
	 * @return [success]
	 */
	public static function create($field) {
		//Connect database

		$database = Database::getConnect();
		//Insert in database
		$q = "INSERT INTO figurita (name, citie, user, file, createdAt)
		VALUES (:name, :citie, :user, :file, now()) ";
		
		$stmt = $database->prepare($q);
		$success = $stmt->execute([
			'name' => $field['name'],
			'citie' => $field['citi'],
			'user' => Session::get('id'),
			'file' => null
		]);


		if(!$success) {
			throw new Exception("Error al crear una figurita");
		}

		//Return success and data

		$fg = new Figurita;
		$fg->id = $database->lastInsertId();
		$fg->name = $field['name'];
		$fg->citi = $field['citi'];
		

		return $fg;

	}


	/**
	 * List all figuritas 
	 * @return [array]
	 */
	public static function listAll() {

		$listArr = array();

		//Connect database
		$db = Database::getConnect();
		//Select figurita and orderby date
		$query = "SELECT * FROM figurita
				WHERE user = :user ORDER BY createdAt DESC";
		$stmt = $db->prepare($query);
		$success = $stmt->execute([
			'user' => Session::get('id'),
		]);

		while ($fl = $stmt->fetch(PDO::FETCH_ASSOC)) {

			 array_push($listArr, $fl);
		}

		return $listArr;
		
		

	}

	/**
	 * Delete figurita
	 * @param  [id]
	 * @return [true]
	 */
	public static function remove($field) {

		//Connect database
		$db = Database::getConnect();
		//remove record in table figurita
		$query = "DELETE FROM figurita
				WHERE user = :user AND id = :id";

		$stmt = $db->prepare($query);
		$success = $stmt->execute([
			'user' => Session::get('id'),
			'id' => $field['id']
		]);


		if(!$success) {
			throw new Exception("Error al eliminar una figurita");
		}

		if($success) {
			
			return true;
		}


	}



	/**
	 * Get image 
	 * @param  [id]
	 * @return [image]
	 */
	public static function viewImg($id) {

		//Connect database
		$db = Database::getConnect();
		//Select files related user
		$query = "SELECT * FROM files
				WHERE id = :files AND gallery = :status";
		$stmt = $db->prepare($query);
		$success = $stmt->execute([
			'files' => $id,
			'status' => 1
		]);

		if ($fl = $stmt->fetch(PDO::FETCH_ASSOC)) {
			//Return echo url filename
			echo 'uploads/'. $fl['name'];
		}


	}

	/**
	 * Search find figuritas
	 * @param  [query input]
	 * @return [data]
	 */
	public static function search($field) {

		//is array
		$listArr = array();

		//Connect database
		$database = Database::getConnect();
		
		//Select figurita search 
		$query = "SELECT * FROM figurita
		WHERE name LIKE :search";
		
		$stmt = $database->prepare($query);
		$success = $stmt->execute([
			'search' => '%' . $field['search'] . '%'
		]);

		if($success) {

			while ($fl = $stmt->fetch(PDO::FETCH_ASSOC)) {
				array_push($listArr, $fl);
			}
			return $listArr;
		}


		
		

	}



}


 ?>