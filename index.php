<?php
include 'config/config.php';
$session            =   new Session;
$userSessionVals    =   $session->userLoggedIn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>:: Company ABC and sons</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div class="container">
        <div class="row">

            <div class="col-md-4 col-md-offset-4">

                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                       <!-- -->
                    <?php  
                        $userclass          = new UserClass(); //userloginclass
                        $Validator          = new Validator(); //validation class
                            if(isset($_POST['userLogin'])) {
                            $data_to_validate       = array(
                                    'Please specify your email address' => ($_POST['email']),
                                    'Please specify your Password'      => ($_POST['password']),
                            );
                            $validate   = $Validator->validateExistence($data_to_validate);
                            if(!empty($validate)) { // Not all fields were filled
                                $ret            = '<ul class="alert alert-danger unstyled alert-short">'.$validate.'</ul>';
                            }else{
                              $ret        = $userclass->userLogin();
                            }
                        }
                        echo $ret;
                    ?>
                    <form method="POST" action="">
                        <fieldset>
                            <div class="form-group">
                                <input  class="form-control" placeholder="E-mail" name="email" type="email">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" >
                            </div>
                            <div class="checkbox">
                                
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" name="userLogin" class="btn btn-lg btn-success btn-block">Login</button>
                        </fieldset>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
