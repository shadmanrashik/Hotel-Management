<!DOCTYPE html>
<html lang="en">
<?php
    require 'database/connect.php';
    require 'database/core.php';

    if(loggedin()){
        header('Location: index.php');
    }
    if(isset($_POST['username']) && $_POST['password']) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $passwordHash = md5($password); //generated md5 hash string

        if(!empty($username) && !empty($password)) {
            $query = "SELECT id FROM users WHERE username = '".mysql_real_escape_string($username)."' "
                    . "AND password = '".mysql_real_escape_string($passwordHash)."'";
            //magic_quotes_gpc can be turned 'On' to prevent possible sql injection in php.ini(Line 786)    
            //above feature is no longer supported by current php
            $queryRun = mysql_query($query);
            if($queryRun) {
                $queryNumberOfRows = mysql_num_rows($queryRun);
                if ($queryNumberOfRows == 0) { 
                    $alert = TRUE;
                }
                else if($queryNumberOfRows == 1) {     //will return 1 if the fields are matched since username is unique
                    $userId = mysql_result($queryRun, 0, 'id');
                    $_SESSION['userid'] = $userId;     //create current session
                    header('Location: index.php');
                }
            }
        }
    }    
?>
        
<head>
    <title>Hotel - Log In</title>
    
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container vertical-center">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" role="form">
                            <fieldset>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input class="form-control" placeholder="Username" name="username" type="text" required="" autofocus>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required="">
                                
                                </div>
                                <?php if($alert) { ?>
                                    <div class="alert alert-danger">
                                        Invalid Username/Password combination.
                                    </div> <?php
                                } ?> 
                                <div class="text-center">
                                    <a href="forgotPassword.php">Forgotten Password? <span class="fa fa-key"></span></a><br><br>
                                </div>
                                <!-- Submit Form -->
                                <button type="submit" class="btn btn-lg btn-primary btn-block"><span class="glyphicon glyphicon-log-in"></span> Log In </button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


</body>

</html>
