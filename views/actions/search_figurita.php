<?php 

	header('Content-Type: application/json; charset=utf-8');

	$data = file_get_contents('php://input');
	$field = json_decode($data, true);
	
	$search = Figurita::search($field);

	if($search){
		
		echo json_encode([
			'status' => 1,
			'data' => $search
		]);


	} else {

		echo json_encode([
			'status' => 0,
			'data' => 'Error al buscar... :('
		]);

	}


	
 ?>