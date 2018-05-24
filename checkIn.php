<?php
    include 'header.php';
?>      

<?php
    if($_SERVER["REQUEST_METHOD"] == "GET") {
        $roomNumber = $_GET['hiddenRoomNumber'];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $firstName = testInput($_POST['firstName']);
        $lastName = testInput($_POST['lastName']);
        $address = testInput($_POST['address']);
        $city = testInput($_POST['city']);
        $division = testInput($_POST['division']);
        $postalCode = testInput($_POST['postCode']);
        $roomNumber1 = $_POST['roomNumber'];
        $checkInDate = $today;
        $checkOutDate = testInput($_POST['checkOutDate']);
        $phoneNumber = testInput($_POST['phoneNumber']);
        $email = testInput($_POST['email']);
                
        $insertClientQuery = "INSERT INTO client(first_name,last_name,phone_number,address,city,division,post_code,email) VALUES('$firstName','$lastName','$phoneNumber','$address','$city','$division','$postalCode','$email')";
        $queryRun = mysql_query($insertClientQuery);
        if($queryRun) {
            
            $selectClientIdQuery = "SELECT id FROM client WHERE first_name = '$firstName' AND last_name='$lastName' AND phone_number='$phoneNumber'";
            $queryRun = mysql_query($selectClientIdQuery);
            if($queryRun) {
                
                $clientId = mysql_result($queryRun, 0, 'id');
                $roomBookQuery = "INSERT INTO book_room(room_number,client_id,check_in_date,check_out_date) VALUES('$roomNumber1','$clientId','$checkInDate','$checkOutDate')";
                $queryRun = mysql_query($roomBookQuery);
                if($queryRun) {
                    header("Location: checkOut.php");
                }
            }
        }
    }
?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Check <small>In</small> <i class="fa fa-fw fa-sign-in pull-right"></i>
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
                <h1 class="well text-center">Registration Form</h1>
                <div class="col-lg-12 well">
                    <div class="row">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" role="form">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6 form-group">
                                    <label><u>First Name</u> *</label>
                                        <input class="form-control" name="firstName" type="text" placeholder="Enter First Name Here.." required autofocus>
                                </div>
                                <div class="col-sm-6 form-group">
                                        <label><u>Last Name</u> *</label>
                                        <input class="form-control" name="lastName" type="text" placeholder="Enter Last Name Here.." required>
                                </div>
                            </div>					
                            <div class="form-group">
                                <label><u>Address</u> *</label>
                                <input class="form-control" placeholder="Enter Address Here.." rows="3" name="address" required>
                            </div>	
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                        <label>City</label>
                                        <input  class="form-control" name="city" type="text" placeholder="Enter City Name Here..">
                                </div>	
                                <div class="col-sm-4 form-group">
                                        <label>Division/State</label>
                                        <input class="form-control" name="division" type="text" placeholder="Enter Division/State Name Here..">
                                </div>	
                                <div class="col-sm-4 form-group">
                                        <label>Post Code</label>
                                        <input type="text" name="postCode" placeholder="Enter Postal Code Here.." class="form-control">
                                </div>		
                            </div>
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label><u>Room Number</u> *</label>
                                        <input class="form-control" type="text" name="roomNumber" placeholder="Enter Room number Here.." value="<?php echo $roomNumber; ?>" >
                                </div>		
                                <div class="col-sm-4 form-group">
                                        <label><u>Check In Date</u> <small>(TODAY)</small> *</label>
                                        <input type="date" class="form-control" name="checkInDate" disabled value="<?php echo $today;?>" required>
                                </div>		
                                <div class="col-sm-4 form-group">
                                        <label><u>Check Out Date</u> *</label>
                                        <input type="date" class="form-control" name="checkOutDate" placeholder="Enter Check Out Date" min="<?php echo $today;?>" required>
                                </div>	
                            </div>						
                            <div class="form-group">
                                <label><u>Phone Number</u> *</label>
                                <input type="text" placeholder="Enter Phone Number Here.." name="phoneNumber" class="form-control" required>
                            </div>		
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" placeholder="Enter Email Address Here.." name="email" class="form-control">
                            </div>
                            <div class="alert alert-warning fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><i class="fa fa-info-circle"></i></strong> Fields marked with <em>asterisk(*) & <u>underline</u> </em> are required.
                            </div>
                            <div>
                                <button type="submit" class="btn btn-lg btn-success">Submit</button>
<!--                                <button type="cancel "class="btn btn-default btn-lg pull-right" onclick="javascript:document.location.href='index.php';return false;">Go Back</button>-->
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