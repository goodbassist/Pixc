<?php 

/** Author:  Badejo Oluwatobi
* Class to manage Page Controls and Presentation
*/
class Pages
{
	public function __construct(){

	}
	public function headTag()
	{
		$ret ='<!DOCTYPE html>
				<html lang="en">
				<head>
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<meta name="description" content="">
				<meta name="author" content="">
				<base href="'.$_SERVER['PHP_SELF'].'" />

				<title>:: Company ABC and sons</title>

				<!-- Bootstrap Core CSS -->
				<link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

				<!-- MetisMenu CSS -->
				<link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

				<!-- Timeline CSS -->
				<link href="dist/css/timeline.css" rel="stylesheet">

				<!-- Custom CSS -->
				<link href="dist/css/sb-admin-2.css" rel="stylesheet">

				<!-- Morris Charts CSS -->
				<link href="bower_components/morrisjs/morris.css" rel="stylesheet">

				<!-- Custom Fonts -->
				<link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
				</head>
				<body>
    				<div id="wrapper">';
				return $ret;
	}

	

	public function navigation($nav_data,$userFullName)
	{
		$PagesClass     = new PagesClass;
		$ret = ' 
		<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="">ABC AND SONS</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">               
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> '.$userFullName.' <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <!--<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>-->
                       <li><a href="logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    '.$PagesClass->loadLeftNav($nav_data).'
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>';
        return $ret;
	}

	public function body($pageTitle,$content)
	{
		$ret = '
		<div id="page-wrapper">
		            <div class="row">
		                <div class="col-lg-12">
		                    <h1 class="page-header">'.$pageTitle.'</h1>
		                </div>
		            </div>
		            <div class="row">
		                '.$content.'  
		            </div>
		        </div>
		    </div>';
    return $ret;
	}
	public function dashboard($page_role)
	{	
		$Records 			= 	new Records;
		$PagesClass    		= 	new PagesClass;
		$session  			= 	new Session;
		$userSessionVals 	=	$session->checkUserLogin();
		$role         		= 	$userSessionVals['role'];
		$pageRightCheck		=	$PagesClass->checkLinkHasRight($page_role, $role);
		$userRecords 		= 	$Records->userRecords();
		if ($role == 1) {
			$customers 			= 	$Records->customerRecords();
		}else{
			$customers 			= 	$Records->customerRecordsByUser();
		}
		if ($pageRightCheck == TRUE) {
		$userCount  = '
		<div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">'.count($userRecords).'</div>
                        <div>User(s)</div>
                    </div>
                </div>
            </div>
            <a href="users">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>';
		}else{
			$userCount ='';
		}
		$ret ='<div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">'.count($customers).'</div>
                                    <div>Customer(s)</div>
                                </div>
                            </div>
                        </div>
                        <a href="customers">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                '.$userCount.'
                ';
                return $ret;
	}

	public function users()
	{
		$Records 		= 	new Records();
		$userRecords 	= 	$Records->userRecords();
		$ret ='
		<div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                   
                </div>
               <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Group</th>
                                <!--<th>Action</th>-->	
                            </tr>
                        </thead>
                        <tbody>';
                foreach ($userRecords as  $value) {
                		$ret .='
                            <tr class="odd gradeX">
                                <td>'.$value['lastname'].' '.$value['firstname'].'</td>
                                <td>'.$value['user_group'].' </td>
                               <!-- <td><button class="btn btn-danger" id="deleteUser"><i class="fa fa-trash fa-fw"></i>Delete</button></td>-->
                            </tr>';
                        }
                        $ret .='
                            </tbody>
                    </table>
                </div>
            </div>
         </div>';
		return $ret;
	}

	public function customers()
	{
		$Records 			= 	new Records();
		$session  			= 	new Session;
		$PagesClass    		= 	new PagesClass;
		$userSessionVals 	=	$session->checkUserLogin();
		$role         		= 	$userSessionVals['role'];
		$editPageRight		=	$PagesClass->checkLinkHasRight('edit_customer', $role);
		$newCustomerPageRight		=	$PagesClass->checkLinkHasRight('new_customer', $role);
		if ($newCustomerPageRight == TRUE) {
			$newCustomerLink	= '<a class="btn btn-primary pull-left " href="newcustomer"><i class="fa fa-plus fa-fw"></i>Create New Customer</a>';
		}else{
			$newCustomerLink ='';
		}
		if ($role == 1) {
			$customers 			= 	$Records->customerRecords();
		}else{
			$customers 			= 	$Records->customerRecordsByUser();
		}
		
		$ret ='
		<div class="col-lg-12" style="padding-bottom:10px;">
		'.$newCustomerLink.'
		</div>
		<div id="response"></div>
		<div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    
                </div>
               <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Created By</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>';
                foreach ($customers as  $value) {
                	if ($editPageRight == TRUE) {
						$editCustomerLink	= '<a href="p/editcustomer/'.$value['id'].'" class="btn btn-success"><i class="fa fa-edit fa-fw"></i>Edit</a>';
					}else{
						$editCustomerLink ='';
					}
                	$CategoryClass = new CategoryClass;
                    $fetchSems = $CategoryClass->fetchCats('users', array('id' => $value['created_by']));
                    $createdBy = $fetchSems[0]['lastname'].' '.$fetchSems[0]['firstname'];
                		$ret .='
                            <tr  id="'.$value['id'].'">
                                <td>'.$value['lastname'].' '.$value['firstname'].'</td>
                                <td>'.$createdBy.'</td>
                                <td>'.$value['status'].'</td>
                                <td>
                                	'.$editCustomerLink.'
	                                <a href="p/viewcustomer/'.$value['id'].'" class="btn btn-success"><i class="fa fa-search-plus fa-fw"></i>View</a>
                                <a class="btn btn-danger" id="deleteCustomer2"><i class="fa fa-trash fa-fw"></i>Delete</a>
	                              
                                </td>
                            </tr>';
                        }
                        $ret .='
                            </tbody>
                    </table>
                </div>
            </div>
         </div>';
		return $ret;
	}

	public function newCustomers()
	{
		$Records 		= 	new Records();
		$userRecords 	= 	$Records->userRecords();
		$ret ='
		<div class="col-lg-6">
		<div id="response"></div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    
                </div>
               <div class="panel-body">
               <form role="form" id="customer-form">
	                <div class="form-group">
	                    <label>Firstname</label>
	                    <input type="text" class="form-control" Placeholder="Enter Firstname" name="firstname">
	                </div>
	                <div class="form-group">
	                    <label>Lastname</label>
	                    <input type="text" class="form-control" Placeholder="Enter Lastname" name="lastname">
	                </div>
	                <div class="form-group">
	                    <label>Date of Birth</label>
	                    <input type="text" class="form-control" Placeholder="Day/Month/Year" name="dob">
	                </div>
	                <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="gender">
                            <option selected="selected" value="">Select Your Gender</option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                     <div class="form-group">
	                    <label>Address</label>
	                    <input type="text" class="form-control" Placeholder="Enter Address" name="address">
	                </div>
	                <div class="form-group">
	                    <label>Email Address</label>
	                    <input type="email" class="form-control" Placeholder="Enter E-mail address" name="email">
	                </div>
	                <div class="form-group">
	                    <label>Phone Number</label>
	                    <input type="text" class="form-control" Placeholder="Enter Phone Number" name="phone">
	                </div>
	                <button type="submit" id="btn-customer" class="btn btn-lg btn-success btn-block">Submit</button>
	            </form>
            </div>
         </div>
         ';
		return $ret;
	}

	public function editCustomer($customerID)
	{
		$Records 		= 	new Records();
		$userRecords 	= 	$Records->userRecords();
		$customerRecords = $Records->customerRecordById($customerID);
		if ($customerRecords[0]['gender'] == 'male') { $male = 'selected = "selected"';}
		 if ($customerRecords[0]['gender'] == 'female') { $female = 'selected = "selected"';}
		$ret ='
		<div class="col-lg-6">
		<div id="response"></div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    
                </div>
               <div class="panel-body">
               <form role="form" id="customer-form">
	                <div class="form-group">
	                    <label>Firstname</label>
	                    <input type="hidden"  value="'.$customerRecords[0]['id'].'" name="customerID">
	                    <input type="text" class="form-control" value="'.$customerRecords[0]['firstname'].'" name="firstname">
	                </div>
	                <div class="form-group">
	                    <label>Lastname</label>
	                    <input type="text" class="form-control"  value="'.$customerRecords[0]['lastname'].'" name="lastname">
	                </div>
	                <div class="form-group">
	                    <label>Date of Birth</label>
	                    <input type="text" class="form-control"  value="'.$customerRecords[0]['dob'].'" name="dob">
	                </div>
	                <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="gender">
                            <option '.$male.'>Male</option>
                            <option '.$female.'>Female</option>
                        </select>
                    </div>
                     <div class="form-group">
	                    <label>Address</label>
	                    <input type="text" class="form-control" value="'.$customerRecords[0]['address'].'" name="address">
	                </div>
	                <div class="form-group">
	                    <label>Email Address</label>
	                    <input type="email" class="form-control" value="'.$customerRecords[0]['email'].'" name="email">
	                </div>
	                <div class="form-group">
	                    <label>Phone Number</label>
	                    <input type="text" class="form-control" value="'.$customerRecords[0]['phone'].'" name="phone">
	                </div>
	                <button type="submit" id="btn-edit-customer" class="btn btn-lg btn-success btn-block"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Edit Customer</button>
	            </form>
            </div>
         </div>
         ';
		return $ret;
	}

	public function viewCustomer($customerID)
	{
		$Records 		= 	new Records();
		$userRecords 	= 	$Records->userRecords();
		if ($role == 1) {
			$customerRecords = $Records->customerRecordById($customerID);
		}else{
			$customerRecords = $Records->customerRecordById2($customerID);
		}
		if ($customerRecords[0]['gender'] == 'male') { $male = 'selected = "selected"';}
		 if ($customerRecords[0]['gender'] == 'female') { $female = 'selected = "selected"';}
		$ret ='
		<div class="col-lg-6">
		<div id="response"></div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    
                </div>
               <div class="panel-body">
               <form role="form" id="customer-form">
	                <div class="form-group">
	                    <label>Firstname</label>
	                    <input type="hidden"  value="'.$customerRecords[0]['id'].'" name="customerID">
	                    <input type="text" class="form-control" value="'.$customerRecords[0]['firstname'].'" name="firstname" disabled>
	                </div>
	                <div class="form-group">
	                    <label>Lastname</label>
	                    <input type="text" class="form-control"  value="'.$customerRecords[0]['lastname'].'" name="lastname" disabled>
	                </div>
	                <div class="form-group">
	                    <label>Date of Birth</label>
	                    <input type="text" class="form-control"  value="'.$customerRecords[0]['dob'].'" name="dob"  disabled>
	                </div>
	                <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="gender"  disabled>
                            <option '.$male.'>Male</option>
                            <option '.$female.'>Female</option>
                        </select>
                    </div>
                     <div class="form-group">
	                    <label>Address</label>
	                    <input type="text" class="form-control" value="'.$customerRecords[0]['address'].'" name="address"  disabled>
	                </div>
	                <div class="form-group">
	                    <label>Email Address</label>
	                    <input type="email" class="form-control" value="'.$customerRecords[0]['email'].'" name="email"  disabled>
	                </div>
	                <div class="form-group">
	                    <label>Phone Number</label>
	                    <input type="text" class="form-control" value="'.$customerRecords[0]['phone'].'" name="phone"  disabled>
	                </div>
	            </form>
            </div>
         </div>
         ';
		return $ret;
	}


	public function footer($jquery='')
	{
		$ret ='</div>
				<script src="bower_components/jquery/dist/jquery.min.js"></script>
				<script src="js/functions.js"></script>
			    <!-- Bootstrap Core JavaScript -->
			    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
			    <!-- Metis Menu Plugin JavaScript -->
			    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>
			    <!-- Morris Charts JavaScript -->
			     <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
			    <script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
			    <!-- Custom Theme JavaScript -->
			    <script src="dist/js/sb-admin-2.js"></script>
			    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
			    <script>
			    $(document).ready(function() {
			        $("#dataTables-example").DataTable({
			                responsive: true
			        });
			    });
			    </script>
			</body>
			</html>';
			return $ret;
	}

}

?>