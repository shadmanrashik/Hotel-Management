<!DOCTYPE html>
<html lang="en">
<?php
    require 'database/connect.php';
    require 'database/core.php';

    
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
                <div class="login-panel panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Password Recovery</h3>
                    </div>
                    <div class="panel-body">
                        <form action="passwordRecovery.php" method="GET" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <label>ENTER YOUR USERNAME</label> 
                                    <input class="form-control" placeholder="Username" name="username" type="text" required="" autofocus>
                                </div>
                                <div class="form-group">
                                    <label>CHOOSE A RECOVERY METHOD</label><br>
                                    <label class="radio-inline"><input type="radio" name="optradio" value="1">Security Question</label>
                                    <label class="radio-inline"><input type="radio" name="optradio" value="2">Email</label>
                                </div>
                                <button type="submit" class="btn btn-md btn-default">Submit</button>
                                <button type="cancel "class="btn btn-danger pull-right" onclick="javascript:document.location.href='login.php';return false;">Cancel</button>
                                <!-- Submit Form -->
                                
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
