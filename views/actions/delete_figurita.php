<?php 

	header('Content-Type: application/json; charset=utf-8');

	$data = file_get_contents('php://input');
	$field = json_decode($data, true);
	
	$delete = Figurita::remove($field);

	if($delete){

		
		echo json_encode([
			'status' => 1,
			'data' => false
		]);


	} else {

		echo json_encode([
			'status' => 0,
			'data' => 'Error al borrar figurita :('
		]);

	}


	
 ?>