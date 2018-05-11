<?php 


class Validation {

	/**
	 * [$errors all]
	 * @var [type]
	 */
	public $errors;
	


	public function __invoke(array $data)
	{
		$this->clear();
		$errors = array();	

		//foreach
		foreach((array) $this as $key => $function)
		{
			$value = NULL;


			if(isset($data[$key]))
			{
				$value = $data[$key];
			}

			$error = $function($value, $key, $this);
			
			if($error)
			{
				//Adding erros
				$errors[$key] = $error;
			}

		}

		$this->errors = $errors;
		return !$errors;
	}
	
	/**
	 * clear
	 * @return [clear]
	 */
	public function clear()
	{
		unset($this->errors);
	}


	/**
	 * errors
	 * @return [errors]
	 */
	public function errors()
	{
		return $this->errors;
	}

	/**
	 * done
	 * @return boolean
	 */
	public function done()
	{
		if(count($this->errors) == 0) {
			return true;
		}  else {
			return false;
		}

	}

}


 ?>