

<?php 

	require 'autoload.php';
	include 'config/settings.php';

	if($view == 'ajax'):?>

 	<?php include 'views/actions/new_figurita.php'; ?>

 	<?php 

 	elseif ($view == 'removeajax'):

 	 ?>
	
	<?php  include 'views/actions/delete_figurita.php'; ?>
	

<?php else: ?>

 

<?php 
	
	include './views/static/header.php';

	switch($view){

		case 'inicio':
		case 'Inicio':
			include 'views/home.php';
			break;

		case 'register':
		case 'Register':
			include 'views/register.php';
			break;

		case 'continueregister':
		case 'Continueregister':
			include 'views/continue.php';
			break;

		case 'panel':
		case 'panel':
			include 'views/panel.php';
			break;

		default:
			echo "error";

	}

	include './views/static/footer.php';

 ?>



<?php endif; ?>