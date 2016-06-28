<?php 
include '../config/config.php';
 	$Validator          = new Validator(); //validation class
 	$session  			= 	new Session;
 	$DbClass 			= new DbClass;
	$userSessionVals 	=	$session->checkUserLogin();
	$userID         	= 	$userSessionVals['userID'];
    $data_to_validate       = array(
            'Please specify the <strong>Firstname</strong>' 	=> 	$_POST['firstname'],
            'Please specify the <strong>Lastname</strong>'  	=>  $_POST['lastname'],
            'Please specify the <strong>Date OF Birth</strong>' =>  $_POST['dob'],
            'Please specify the <strong>Gender</strong>' 		=>  $_POST['gender'],
            'Please specify the <strong>Address</strong>' 		=>  $_POST['address'],
            'Please specify the <strong>Email Address</strong>' =>  $_POST['email'],
            'Please specify the <strong>Phone Number</strong>' =>   $_POST['phone'],
    );
    $validate   = $Validator->validateExistence($data_to_validate);
    if(!empty($validate)) { // Not all fields were filled
        $ret            .= '<ul class="alert alert-danger unstyled alert-short">'.$validate.'</ul>';
    }else{
	     $inputdata = array(
	     		'firstname' 	=> 	$_POST['firstname'],
	     		'lastname'  	=>  $_POST['lastname'],
	     		'dob'			=>  $_POST['dob'],
	     		'gender'		=>  $_POST['gender'],
	     		'address'		=>  $_POST['address'],
	     		'email'			=>  $_POST['email'],
	     		'phone'			=>  $_POST['phone'],
	     		'created_by'	=>  $userID,
	     		'created_date'	=>  time(),
	     		'status'		=>  'active',
	     		'is_deleted'	=>  FALSE,
	     );
	     $email = $_POST['email'];
	     $checkCustomerExist = $DbClass->db->select("customers","email='$email'");
	     if ($checkCustomerExist) {
	     	$ret = '<div class="alert alert-danger">
	                         Email Already Exist
	                 </div>';
	     }else{
	     $insertCustomer = $DbClass->db->insert('customers',$inputdata);
			     if ($insertCustomer) {
		     	$ret = '<div class="alert alert-success">
		                         Customer Created Successfully
		                 </div>';
			     }
	 		}
    }
    echo $ret;
 ?>