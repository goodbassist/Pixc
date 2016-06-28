<?php 


/**
* Author: Badejo Oluwatobi
*UserClass to handle all user logic
*/
class UserClass  
{
	
	public function userLogin()
	{	
		$DbClass 						= new DbClass;
		$email						= $_POST['email'];
		$password						= $_POST['password'];
		$paramArray 					= array(
				":email" 				=> $email,
		);
		$sth = $DbClass->db->prepare('SELECT * FROM users WHERE email = :email');
		$sth->execute($paramArray);
		$count = $sth->rowCount();
		$row   = $sth->fetch();
		if ($count > 0 ) {
			$passhass 	= $row['password_hash'];
			$userID 	= $row['id'];
			$passwordCheck  = $DbClass->db->validateSecret($password,$passhass);
			if ($passwordCheck) {
				$userGroup = $DbClass->db->select('user_group',"userid = '$userID'");
				if ($userGroup) {
					session_start();
					$_SESSION['role'] 		= $userGroup[0]['groupid'];
					$_SESSION['userID'] 	= $userID;  // userID in SESSION
					header("Location:dashboard");
				}else{
					$ret = 	'<div class="alert alert-danger">
                         Username OR passsword Wrong
                        </div>';
				}
				}else{
					$ret = 	'<div class="alert alert-danger">
                         Username OR passsword Wrong
                        </div>';
				}					
			}else{
				$ret = 	'<div class="alert alert-danger">
                         Username OR passsword Wrong
                        </div>';
		}	
		return $ret;			
	}

	public function userDetails($userID)
	{
		$DbClass 						= new DbClass;
		return $DbClass->db->select("users","id='$userID'");
	}

	public function logout()
	{
		session_start();
		unset($_SESSION['userID']);
		unset($_SESSION['role']);
		$link = $_SERVER['PHP_SELF'];
		header(" location:$link");

	}


}

 ?>