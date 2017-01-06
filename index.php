<?php

require 'classes/AltoRouter.php';

$router = new AltoRouter();
	
	$router->setBasePath('/sgp-dev');
	
	// MATCH ROUTING - DEFAULT
		$router->map('GET','/', 'components/home/index.php', 'home');

	// CRYPTO ALGORITHM
		$router->map('GET','/crypto/[a:psw]', 'components/crypto/index.php', 'crypto');

	// USERS 
		// ALL USERS
		$router->map('GET','/usuarios/all', 'components/usuarios/index.php', 'users-all');

		// GET USERS BY ID
		$router->map('GET','/usuario/[i:id]', 'components/usuarios/get.php', 'user-by-id');

		// INSERT NEW USER 
		$router->map('POST','/usuario/new', 'components/usuarios/post.php', 'user-new');

	// match current request
	$match = $router->match();

	if($match) {
	  require $match['target'];
	} else {
	   echo json_encode( array("response" => "404") );
	}

?>