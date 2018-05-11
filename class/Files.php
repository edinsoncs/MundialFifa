<?php 


class Files {


	/* My Properties */
	public static $img;



	/**
	 * @param  [field]
	 * @param  [files]
	 * @return [boolean]
	 */
	public static function newImg($field, $files) {

		//Register complet account
		if(isset($field['complet'])) {

			//create image and save folder correct
			$cImage = self::createImage($field, $files);

			//if save success
			if($cImage)  {

				//connect daabase
				$database = Database::getConnect();
				
				//Create and upload avatar user
				$q = "INSERT INTO files (name, avatar, user, gallery, createdAt)
				VALUES (:name, :avatar, :user, :gallery, NOW()) ";
				$stmt = $database->prepare($q);
				$success = $stmt->execute([
					'name' => $cImage,
					'avatar' => 1,
					'gallery' => 0,
					'user' => Session::get('id')
				]);


				if($success) {


					//Modify user avatar true
					$u = "UPDATE user SET status = :status WHERE id = :id ";
					$stmt = $database->prepare($u);
					$continue = $stmt->execute([
						'id' => Session::get('id'),
						'status' => 1

					]);

					if($continue) {
						return true;
					}

				} else {
					throw new Exception("Error al subir la imagen");
				}

			}

			

		}

	}


	/**
	 * Create image and correct folder
	 * @param  [field]
	 * @param  [files]
	 * @return [name file]
	 */
	public static function createImage($field, $files) {
		//generate id and concat name to file
		$name = uniqid() . "{$files['avatar']['name']}";
		//save in folder
		$folder = __DIR__ . "/../uploads/" . $name;
		//move image correct folder
		$result = move_uploaded_file($files['avatar']['tmp_name'], $folder);
		
		//if boolean
		if($result) {
			//name the file
			return $name;
		} else {
			return false;
		}
		
	}

	/**
	 * 
	 * @param  [id]
	 * @return [boolean]
	 */
	public static function removeImage($field){
		
		$database = Database::getConnect();
		$q = "DELETE FROM files WHERE id = :id AND user = :user";
		$stmt = $database->prepare($q);
		$success = $stmt->execute([
			'id' => $field['remove'],
			'user' => Session::get('id')
		]);

		return $success;

	}

	/**
	 * Update image 
	 * @param  [field]
	 * @param  [files]
	 * @return [boolena]
	 */
	public static function updateImg($field, $files) {

		//User update
		if(isset($field['update'])) {
			//Remove image
			$rImage = self::removeImage($field);

			//if image remove continue
			if($rImage) {

				//Create new image and save folder 
				$cImage = self::createImage($field, $files);

				//Connect database
				$database = Database::getConnect();
				//New upload avatar user
				$q = "INSERT INTO files (name, avatar, user, gallery, createdAt)
				VALUES (:name, :avatar, :user, :gallery, NOW()) ";
				$stmt = $database->prepare($q);
				$success = $stmt->execute([
					'name' => $cImage,
					'avatar' => 1,
					'gallery' => 0,
					'user' => Session::get('id')
				]);

				if($success) {
					return true;
				}

			} else {

				return false;

			}

		}
		

	}


	/**
	 * New figurita create
	 * @param  [field]
	 * @param  [files]
	 * @return [boolean]
	 */
	public static function newFigurita($field, $files) {

		$cImage = self::createImage($field, $files);

		if($cImage) {
			//Database connect
			$database = Database::getConnect();
			//New upload avatar user
			$q = "INSERT INTO files (name, avatar, gallery, user, createdAt)
			VALUES (:name, :avatar, :gallery, :user, now()) ";
			$stmt = $database->prepare($q);
			$success = $stmt->execute([
				'name' => $cImage,
				'avatar' => 0,
				'gallery' => 1,
				'user' => Session::get('id')
			]);

			if($success) {

				$u = "UPDATE figurita SET file = :file WHERE id = :id ";
				$stmt_ = $database->prepare($u);
				$continue = $stmt_->execute([
					'id' => $field['idfigurita'],
					'file' => $database->lastInsertId()
				]);

				if($continue) {
					return true;
				}

			}


		}

		

	}

}


 ?>