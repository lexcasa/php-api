<?php 
	// INCLUDE CLASS
	require("config/conn.php");
	require("classes/User.php");

	$conn 		= new Connection();
	$objUsr		= new User();
	
	$params 	= json_decode(file_get_contents('php://input'), true);
	$name 		= $match['name'];

	if($params){
		// GET USER BY ID
		if($name == 'user-new'){
			$response = $objUsr->insertUser($conn,$params);
			echo json_encode($response);
		}
	} else {
		echo json_encode( array("response" => 'err') );
	}
	
?>