<?php 
 /** Author: Badejo Oluwatobi	
 * Records Class manages the user and customer records
 */
 class Records 
 {
 	public function userRecords()
 	{
 		$DbClass = new DbClass;
		$userQry = $DbClass->db->prepare("SELECT users.firstname,users.lastname,users.email,users.dob,groups.`name` AS user_group FROM users INNER JOIN user_group ON user_group.userid = users.id INNER JOIN groups ON groups.id = user_group.groupid");
		$userQry->execute();
		$userRecords = $userQry->fetchAll();
		return $userRecords;
 	}

 	public function customerRecords()
 	{
 		$DbClass = new DbClass;
 		return $DbClass->db->select("customers","is_deleted = FALSE");
 	}
 	public function customerRecordsByUser()
 	{
 		
 		$DbClass 			= 	new DbClass;
 		$session  			= 	new Session;
		$userSessionVals 	=	$session->checkUserLogin();
		$userID         	= 	$userSessionVals['userID'];
 		return $DbClass->db->select("customers","created_by='$userID' AND is_deleted = FALSE");
 	}
 	public function customerRecordById($customerID)
 	{
 		$DbClass = new DbClass();
 		$session  			= 	new Session;
		$userSessionVals 	=	$session->checkUserLogin();
		$userID         	= 	$userSessionVals['userID'];
 		$checkCustomerUserAccess = $DbClass->db->select("customers","created_by='$userID' AND id='$customerID' AND is_deleted = FALSE");
 		if ($checkCustomerUserAccess) {
 			$ret = $DbClass->db->select("customers","created_by='$userID' AND id='$customerID' AND is_deleted = FALSE");
 		}else{
 		$page = $_SERVER['PHP_SELF'];
 		//header("location:$page?pagecontrol=404");
 		}
 		return $ret;
 	}
 	public function customerRecordById2($customerID)
 	{
 		$DbClass = new DbClass();
 		$session  			= 	new Session;
		$userSessionVals 	=	$session->checkUserLogin();
		$userID         	= 	$userSessionVals['userID'];
 		$checkCustomerUserAccess = $DbClass->db->select("customers","id='$customerID' AND is_deleted = FALSE");
 		if ($checkCustomerUserAccess) {
 			$ret = $DbClass->db->select("customers","id='$customerID' AND is_deleted = FALSE");
 		}else{
 		$page = $_SERVER['PHP_SELF'];
 		//header("location:$page?pagecontrol=404");
 		}
 		return $ret;
 	}
 	
 }


 ?>