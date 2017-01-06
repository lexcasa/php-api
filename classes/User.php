<?php 

//
// EXAMPLE CLASS
//

class User {

	private $model = "users";

	public function getStructure($conn,$column){
		$sql	="SHOW COLUMNS FROM ".$this->model;
		$d 		= $conn->query($sql);
		$r 		= false;

		for ($i=0; $i < count($d) ; $i++) { 
			if($d[$i]["Field"] == $column){
				$r = true;
			}
		}
		return $r;
	}

	// CRYPTO FUNCTION
	public function cryptoPsw($psw){
		$key 	= "gat0.filh0te";
		$ps 	= strtoupper(sha1($psw.$key));
		return 	$ps;
	}

	// GET USER BY ID
	public function getAllUsers($conn){
		$sql	="SELECT * FROM ".$this->model;
		$d 		= $conn->query($sql);
		
		// CALLBACK
		if(!empty($d)){
			return array("response" => $d);
		} else {
			return array("response" => 'err');
		}
	}

	public function getUserById($conn,$id){
		$sql	="SELECT * FROM ".$this->model." WHERE id='$id'";
		$d 		= $conn->query($sql);
		
		// CALLBACK
		if(!empty($d)){
			return array("response" => $d[0]);
		} else {
			return array("response" => 'err');
		}
	}

	public function insertUser($conn,$user){
		$head 	 ="INSERT INTO ".$this->model;
		$insert .="(";
		$body 	.=" VALUES (";
		$last 	 = count($user);

		// ENCRYPT PSW
		$user["password"] = $this->cryptoPsw($user["password"]);

		$ind 	 = 1;
		foreach ($user as $key => $vle) {
			if($this->getStructure($conn,$md,$key)){
				if($ind==$last){
					$insert .=$key.", createAt, updateAt";
					$body 	.="'".$vle."', NOW(), NOW()";
				} else {
					$insert .=$key.", ";
					$body 	.="'".$vle."', ";
				}
			}
			$ind++;
		}

		$insert .=")";
		$body 	.=")";
		$sql 	 = $head.$insert.$body;
		$d 		 = $conn->query($sql);
		
		// CALLBACK
		if(empty($d)){
			return array("response" => 'OK');
		} else {
			return array("response" => 'err');
		}
	}
}

?>