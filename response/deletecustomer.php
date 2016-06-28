<?php 
include '../config/config.php';
		$DbClass          = new DbClass(); 
	     $inputdata = array(
	     		'is_deleted'		=>  TRUE,
	     );
     	$where = array('id' => $_POST['id']);
		$deleteCustomer = $DbClass->db->update("customers", $inputdata, $where);
	     if ($deleteCustomer) {
     	$ret = '<div class="alert alert-success">
                         Customer Deatails Uddated Successfully
                 </div>';
	   }
    echo $ret;
 ?>