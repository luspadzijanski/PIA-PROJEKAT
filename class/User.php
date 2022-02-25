<?php
class User {	
   
	public $userTable = 'pm_users';	
	public $conn;
	
	public function __construct($db){
        $this->conn = $db;
    }	    
	
	public function login(){
		if($this->email && $this->password) {
			$sqlQuery = "
				SELECT * FROM ".$this->userTable." 
				WHERE email = ? AND password = ?";			
			$stmt = $this->conn->prepare($sqlQuery);
            $password = md5($this->password);
			$stmt->bind_param("ss", $this->email, $password);	
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				$user = $result->fetch_assoc();
				$_SESSION["userid"] = $user['id'];
				$_SESSION["role"] = $user['role'];
				$_SESSION["name"] = $user['first_name']." ".$user['last_name'];

				return 1;		
			} else {
				return 0;		
			}			
		} else {
			return 0;
		}
	}

	public function register(){
		if($this->first_name && $this->last_name && $this->email && $this->password && $this->role) { 
			$password = md5($this->password);
			$sqlQuery = "
				INSERT INTO pm_users (first_name,last_name,email,password,role) VALUES 
				('$this->first_name', '$this->last_name', '$this->email', '$password', '$this->role')";
				//first_name = ? AND last_name = ? AND email = ? AND password = ? AND role = ? ";//			
			$stmt = $this->conn->prepare($sqlQuery);
			//$stmt->bind_param("ss", $this->first_name, $this->last_name, $this->email, $password, $this->role);//
			$stmt->execute();
			//$result = $stmt->get_result();//
			$_SESSION['name']=$this->first_name." ".$this->last_name;
			$_SESSION['role']=$this->role;						
		} 	
	    else {
			return 0;
		}
	}

	public function signedIn (){
		if(!empty($_SESSION["userid"])) {
			return 1;
		} else {
			return 0;
		}
	}
	
	public function loggedIn (){
		if(!empty($_SESSION["userid"])) {
			return 1;
		} else {
			return 0;
		}
	}
}
?>