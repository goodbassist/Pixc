<?php

class Session
{


    public function checkUserLogin()
    {
        $data = array(
                     'userID'   =>$_SESSION['userID'],
                     'role'     =>$_SESSION['role']
                    );
            if(!isset($_SESSION['userID'] ) ){
                header("location: index.php");
            }
        return $data;
    }

    public function userLoggedIn(){
        if(isset($_SESSION['userID'])){
             header("location: dashboard");
        }
    }

    

}