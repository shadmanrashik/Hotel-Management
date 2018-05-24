<?php
    include 'header.php';
?>      

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $username = testInput($_POST['username']);
        $password = testInput($_POST['password']);
        $confirmPassword = testInput($_POST['confirmPassword']);
        $email = testInput($_POST['email']);
        $question = testInput($_POST['question']);
        $answer = testInput($_POST['answer']);
        
        $error = 0;
        
        if(isset($username) && isset($password) && isset($confirmPassword) && isset($email)) {
            $checkDuplicateQueryquery = "SELECT * FROM users WHERE username='$username'";
            $queryRun = mysql_query($checkDuplicateQueryquery);
            if(mysql_fetch_array($queryRun)==0) {
                if($password == $confirmPassword) {
                    $passwordHash = md5($password);
                    $insertQuery = "INSERT INTO users(username,password,email,security_question,security_question_answer) VALUES('$username','$passwordHash','$email','$question','$answer')";
                    $queryRun = mysql_query($insertQuery);

                    if($queryRun) {
                       $info = TRUE;
                    }
                } else {
                    $alert =TRUE;
                    $error = 2;
                }
            } else {
                $alert =TRUE;
                $error = 1;
            }
        }
    }
?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Sign Up <small>Employee</small> <i class="fa fa-fw fa-user pull-right"></i>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-sign-in"></i> <a href="checkIn.php">Check In</a>
                            </li>
                        </ol>    
                    </div>
                </div>
                <h2 class="well text-center">Employee Sign Up Form</h2>
                <div class="col-lg-12 well">
                    <div class="row">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" role="form">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label><u>User Name</u> *</label>
                                    <input class="form-control" name="username" type="text" data-toggle="tooltip" title="username must be unique" required autofocus>
                                </div>
                                <div class="col-sm-6 form-group">
                                <?php if($info) { ?>
                                    <div class="alert alert-success">
                                        Success!
                                    </div> <?php
                                } ?>
                                 <?php if($alert) { ?>
                                    <div class="alert alert-danger fade in">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <i class="fa fa-close"></i><strong> Error! </strong>
                                  <?php if($error==1) {
                                            echo 'username already exists!';
                                        } else if($error == 2) {
                                            echo 'passwords do not match!';
                                        }?>
                                    </div> <?php
                                } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label><u>Password</u> *</label>
                                    <input class="form-control" name="password" type="password" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label><u>Confirm Password</u> *</label>
                                    <input class="form-control" name="confirmPassword" type="password" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label><u>Email</u> *</label>
                                    <input class="form-control" name="email" type="email" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label>Security Question</label>
                                        <input class="form-control" name="question" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label>Security Question Answer</label>
                                        <input class="form-control" name="answer" type="text">
                                </div>
                            </div>
                            <div class="alert alert-warning fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><i class="fa fa-info-circle"></i></strong> Fields marked with <em>asterisk(*) & <u>underline</u> </em> are required.
                            </div>
                            <div>
                                <button type="submit" class="btn btn-lg btn-success">Submit</button>
                                <button type="cancel "class="btn btn-default btn-lg pull-right" onclick="javascript:document.location.href='index.php';return false;">Cancel</button>
                            </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    include 'footer.php';