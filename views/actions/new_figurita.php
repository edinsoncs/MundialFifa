<?php 

	header('Content-Type: application/json; charset=utf-8');

	$data = file_get_contents('php://input');
	$field = json_decode($data, true);
	
	$new = Figurita::create($field);

	if($new){

		echo json_encode([
			'status' => 1,
			'data' => [
				'id' => $new->id,
				'name' => $new->name,
				'citie' => $new->citi
			]
		]);


	} else {

		echo json_encode([
			'status' => 0,
			'data' => 'Error al crear una nueva figurita :('
		]);

	}


	
 ?>