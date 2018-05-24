<!DOCTYPE html>
<html lang="en">
<?php
    require 'database/connect.php';
    require 'database/core.php';
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        if(isset($_GET['username']) && $_GET['optradio']) {
            $userNameRecover = $_GET['username'];
            $optradio = $_GET['optradio'];
            $query = "SELECT * FROM users WHERE username = '$userNameRecover'";
            $runQuery = mysql_query($query);
            $row = mysql_fetch_array($runQuery);
            $id = $row['id'];
            $password = $row['password'];
            $email = $row['email'];
            $securityQuestion = $row['security_question'];
            if($optradio == 2) {
                $to = $email;
                $headers = "From: hotel@sample.com";
                $subject = "Hotel Management Password Recovered";
                $body = "Hotel Management password recovery Script

                    -----------------------------------------------
                
                    email Details is : $to;
                
                    Here is your password  : $password;
                
                    Sincerely,
                
                    Hotel Management Team";
                
                $sentmail = mail ($to, $subject, $body, $headers);
                if($sentmail) {
                    $infoType = 2;
                    $recovery = TRUE;
                    header('Location: index.php?sub=1');
                }
            }
        }
    }
    else {
        header('Location: forgotPassword.php');
    }
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['newPassword']) && $_POST['answer'] && $_POST['id']) {
            $id = $_POST['id'];
            $newPassword = md5($_POST['newPassword']);
            $answer = $_POST['answer'];
            $query = "SELECT * FROM users WHERE id = '$id' AND security_question_answer = '$answer'";
            $queryRun = mysql_query($query);
            if($queryRun) {
                $queryNumberOfRows = mysql_num_rows($queryRun);
                if ($queryNumberOfRows == 1) {
                    $query = "UPDATE users SET password =  '$newPassword' WHERE  id ='$id'";
                    $runQuery = mysql_query($query);
                    if($runQuery) {
                        $recovery=TRUE;
                        header("Location: login.php");
                    }
                }
                else {
                    $alert = TRUE;
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
                <div class="login-panel panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Password Recovery</h3>
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <label>Security Question</label><br>
                                    <input class="form-control" type="text" disabled="" value="<?php 
                                           echo $securityQuestion;
                                    ?>">
                                </div>
                                <div class="form-group">
                                    <label>Your Answer</label><br>
                                    <input class="form-control" placeholder="Answer" name="answer" type="text" required="" autofocus>
                                </div>
                                <div class="form-group">
                                    <label>New Password</label><br>
                                    <input class="form-control" placeholder="Password" name="newPassword" type="password" required="">
                                </div>
                                <input type="hidden" value="<?php echo $id; ?>" name="id">
                                <button type="submit" class="btn btn-md btn-default">Submit</button>
                                <button type="cancel "class="btn btn-danger pull-right" onclick="javascript:document.location.href='login.php';return false;">Cancel</button>
                                <!-- Submit Form -->
                                <?php if($alert) { ?>
                                    <div class="alert alert-danger">
                                        Invalid Answer. Please try again.
                                    </div> <?php
                                } ?>
                                
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
