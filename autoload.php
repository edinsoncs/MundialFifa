<?php

spl_autoload_register(function($className) {
	$filepath = "class/" . $className . ".php";
	if(file_exists($filepath)) {
		require $filepath;
	}
});

// Inicio sesión.
Session::init();