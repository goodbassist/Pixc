<?php 

/*
*Page Loader Loaders Pages Using the Switch and Case Method
*/
include 'config/config.php';
$session  			= 	new Session;
$userclass   		= new UserClass();
$userSessionVals 	=	$session->checkUserLogin();
$userID         	= 	$userSessionVals['userID'];
$role         		= 	$userSessionVals['role'];
$userDetails		=   $userclass->userDetails($userID);
$userFullName		=	$userDetails[0]['lastname'].' '.$userDetails[0]['firstname'];
$var1 				= 	$_GET['pagecontrol'];
$PagesClass    		= 	new PagesClass;
$Pages 		   		= 	new Pages();
switch ($var1) {
	case 'dashboard': //page Case
		$page_role = 'dashboard';
		$pageContent = $Pages->dashboard('user_count');
		$pageTitle = 'Dashboard';
		break;	
	case 'users':
		$page_role = 'users';
		$pageContent = $Pages->users();
		$pageTitle = 'Users';
		break;	
	case 'customers':
		$page_role = 'customers';
		$pageContent = $Pages->customers();
		$pageTitle = 'Customers';
		break;
	case 'newcustomer':
		$page_role = 'new_customer';
		$pageContent = $Pages->newCustomers();
		$pageTitle = 'New Customer';
		break;
	case 'editcustomer':
		$page_role = 'edit_customer';
		$pageContent = $Pages->editCustomer($_GET['cusx']);
		$pageTitle = 'Edit Customer';
		break;
	case 'viewcustomer':
		$page_role = 'view_customer';
		$pageContent = $Pages->viewCustomer($_GET['cusx']);
		$pageTitle = 'View Customer';
		break;
	case '404':
		$page_role = '404';
		$pageContent = 'Page not Available';
		$pageTitle = '404';
		break;
	case 'logout':
		$pageContent = $userclass->logout();
		break;
	default:
		$page_role = 'dashboard';
		$pageContent = $Pages->dashboard('user_count');
		$pageTitle = 'Dashboard';
		break;
}
if(!empty($userSessionVals['userID'])) {
$PagesClass->checkUserHasRightToPage($page_role, $role);
$nav_data     = array(
'active_main'   => $page_role,
'user_class'    => $role,
);
echo $Pages->headTag();
echo $Pages->navigation($nav_data,$userFullName);
echo $Pages->body($pageTitle,$pageContent);
echo $Pages->footer();
}
?>