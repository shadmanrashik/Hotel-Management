<?php
    include 'header.php';
?>
    
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['updateBtn']) || isset($_POST['insertBtn'])) {  //checks if the buttons are clicked
        $number = testInput($_POST['roomNumberTxt']);
        $type = testInput($_POST['roomTypeTxt']);
        $name = testInput($_POST['roomNameTxt']);
        $description = testInput($_POST['roomDescriptionTxt']);
        if (!empty($number) && !empty($type)) {                     //checks if the variables are empty
            if (isset($_POST['updateBtn'])) {
                $categoryId = testInput($_POST['hiddnId']);
                $checkTypeDuplicateQuery = "SELECT number FROM room WHERE number='$number' AND id <> '$categoryId'";
                $runQuery = mysql_query($checkTypeDuplicateQuery);
                if (mysql_num_rows($runQuery) == 0) {
                    $updateQuery = "UPDATE room SET number = '$number', type = '$type', name = '$name', description = '$description' WHERE id = '$categoryId'";
                    $queryRun = mysql_query($updateQuery);
                    if($queryRun) { 
                        $info = TRUE; $updateSuccesInfo = "One row successfully updated!";
                    }
                } else { 
                    $alert = TRUE; $updateFailInfo = "Number already exists! Choose an unique Room Number!";
                }
            } else {    //insert button isset
                $checkTypeDuplicateQuery = "SELECT number FROM room WHERE number='$number'";
                $runQuery = mysql_query($checkTypeDuplicateQuery);
                if(mysql_num_rows($runQuery) == 0) {    //no duplicate number found
                    $insertQuery = "INSERT INTO room(name,type,number,description) VALUES('$name','$type','$number','$description')";
                    $queryRun = mysql_query($insertQuery);
                    if($queryRun) { 
                        $info = TRUE; $insertSuccessInfo = "One row successfully inserted!";
                    }
                } else { 
                    $alert = TRUE; $insertFailInfo = "Number already exists! Choose an unique Room Number!";
                }
            }
        }      
    } else if(isset($_POST['deleteBtn'])) {

        $roomId = testInput($_POST['hiddnId']);
        $deleteQuery = "DELETE from room where id = '$roomId'";

        $queryRun = mysql_query($deleteQuery);
        if($queryRun) {
            $info = TRUE; $deleteSuccessInfo = "One row successfully inserted!";
        }
        else {
            $alert = TRUE; $deleteFailInfo = "Failed to perform action!";
        }
    }
}?>
       
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin <small>Customizations</small> <i class="fa fa-fw fa-th-large pull-right"></i>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-bar-chart-o"></i> Customize Room
                            </li>
                        </ol>
                    </div>       
                </div>
               
                    <h2>Create Room</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Index</th>
                                    <th>Room No.</th>
                                    <th>Type</th>
                                    <th>Room Name</th>
                                    <th>Description</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * from room";
                                $runQuery = mysql_query($query);
                                $count = 1;
                                while($roomQuery = mysql_fetch_array($runQuery)) {
                                    echo "<tr>";
                                        echo "<form method='POST' action='roomManagement.php' autocomplete = off>";
                                        echo "<td>" . $count . "</td>";
                                        echo "<td><input type='text' class='form-control' name='roomNumberTxt' value='".$roomQuery['number']."'></td>";
                                        echo "<td><select class='form-control' name='roomTypeTxt'>";
                                        $query1 = "SELECT * FROM category";     
                                        $runQuery1 = mysql_query($query1);
                                            while($categoryToRoomQuery = mysql_fetch_array($runQuery1)){
                                                echo "<option value='".$categoryToRoomQuery['id']."'"; 
                                                if($categoryToRoomQuery['id']==$roomQuery['type']) { echo "selected";}
                                                echo">".$categoryToRoomQuery['type']."</option>";
                                            } echo "</select></td>";
                                        echo "<td><input type='text' class='form-control' name='roomNameTxt' value='".$roomQuery['name']."'></td>";
                                        echo "<td><input type='text' class='form-control' name='roomDescriptionTxt' value='".$roomQuery['description']."'></td>";
                                        //echo "<td><input type='file' class='form-control' name='roomImageTxt' value='".$row1['image']."'></td>";
                                        echo "<td class='text-center'><button type='submit' name='updateBtn' class='btn btn-primary btn-sm'><i class='fa fa-refresh'></i> Update </button> ";
                                        echo "<button type='submit' Onclick='return ConfirmDelete();' name='deleteBtn' class='btn btn-danger btn-sm'> <i class='fa fa-remove'></i> Delete </button>";
                                        echo "<input type='hidden' name='hiddnId' value='".$roomQuery['id']."'></td>";
                                        echo "</form>";
                                   $count++;
                                echo "</tr>";
                                }
                                echo "<tr>";
                                    echo "<form method='POST' action='roomManagement.php' autocomplete = off>";
                                    echo "<td>" . $count . "</td>";
                                    echo "<td><input type='text' class='form-control' name='roomNumberTxt' autofocus></td>";
                                    echo "<td><select class='form-control' name='roomTypeTxt'>";
                                    $query1 = "SELECT * FROM category";     
                                    $runQuery1 = mysql_query($query1);
                                        while($categoryToRoomQuery = mysql_fetch_array($runQuery1)){
                                            echo "<option value='".$categoryToRoomQuery['id']."'>".$categoryToRoomQuery['type']."</option>";
                                        } echo "</select></td>";
                                    echo "<td><input type='text' class='form-control' name='roomNameTxt'></td>";
                                    echo "<td><input type='text' class='form-control' name='roomDescriptionTxt'></td>";
                                    //echo "<td><input type='file' class='form-control' name='roomImageTxt' value='".$row1['image']."'></td>";
                                    echo "<td class='text-center'><button type='submit' name='insertBtn' class='btn btn-success btn-md'><i class='fa fa-plus'></i> Insert </button> </td>";
                                    echo "</form>";
                                    $count++;
                                echo "</tr>";
                                ?>
                            </tbody>
                        </table>
                    </div>
                
                <?php if($info) { ?>
                    <div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <i class="fa fa-check-circle"></i><strong> Success! </strong>
                        <?php if(isset($insertSuccessInfo)) { echo $insertSuccessInfo;}
                            else if(isset ($updateSuccesInfo)) { echo $updateSuccesInfo; }
                            else if (isset($deleteSuccessInfo)) { echo "$deleteSuccessInfo"; }
                        ?>
                    </div> <?php
                } else if($alert) { ?>
                    <div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <i class="fa fa-close"></i><strong> Warning! </strong>
                        <?php if(isset($insertFailInfo)) { echo $insertFailInfo;}
                        else if(isset($updateFailInfo)) { echo $updateFailInfo;}
                        else if(isset($deleteFailInfo)) { echo $deleteFailInfo;}
                        else if(isset ($fieldNullInfo)) { echo $fieldNullInfo; }   
                        ?>
                    </div> <?php    
                }?>     
            </div>  
        </div>
    </div>
<?php
    include 'footer.php';
?>