<?php

/*
Author : Badejo Oluwatobi
Pages and Permission Class
*/
class PagesClass {

	protected function userClassRights() {
		$DbClass = new DbClass;
		$perms = $DbClass->db->select("role_group");
		foreach ($perms as $key => $value) {
			$exp = explode(',', $value['groups']);
			$name = $value['name'];
			$varx[] = array($name=>$exp);
			foreach ($varx as $key => $value) {
				foreach ($value as $key => $value2) {
					$arr[$key] = $value2;
				}
			}
		}
		return $arr;
	}	

	public function loadLeftNav($data = array()) 
	{
		$active_main 			= $data['active_main'];
		//$active_inner 			= $data['active_inner'];
		$user_class 			= $data['user_class'];

		$ret 				= '
		 <!-- sidebar menu: : -->
            <ul class="nav">
				'.$this->generateLinkWithRights($user_class, 'dashboard', 'dashboard', 'Dashboard', $active_main, 'fa fa-dashboard ').'
				'.$this->generateLinkWithRights($user_class, 'users', 'users', 'Users', $active_main, 'fa fa-th').'
				'.$this->generateLinkWithRights($user_class, 'customers', 'customers', 'Customers', $active_main, 'fa fa-th').'
            </ul>
          <!-- /.sidebar -->
		';
		return $ret;
	}

	protected function generateLinkWithRights($user_class, $link, $code, $description, $active = '', $fa = '', $treeview = '') {
		// Check if user has right
		if(empty($user_class)) return false;
		$checkLinkHasRight 		= $this->checkLinkHasRight($code, $user_class);
		$show_active 			= $code == $active ? 'active' : '';
		return ($checkLinkHasRight == true) ? $this->generateLink($link, $description, $show_active, $fa, $treeview) : false;
	}

	protected function generateLink($link, $description, $active = '', $fa = '', $treeview = '') {
		if(empty($link) || empty($description)) return false;
		return '<li> <a href="'.$link.'"> <i class="'.$fa.'"></i> <span>'.$description.'</span> '.$r_icon.'</a> '.$close;
	}

	public function checkLinkHasRight($code, $user_class) {
		if(empty($code) || empty($user_class)) return false;
		$userClassRights 	= $this->userClassRights();
		$user_rights 		= $userClassRights[$code];
		if(!is_array($user_rights)) return false;
		if(in_array($user_class, $user_rights)) {
			return true;
		}
		return false;
	}

	public function checkUserHasRightToPage($code, $user_class) {
		$checkLinkHasRight 		= $this->checkLinkHasRight($code, $user_class);
		if($checkLinkHasRight == false) { // User does not have right
			header("location: 404");
		}
	}


}