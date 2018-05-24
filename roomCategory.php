<?php
    include 'header.php';  
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['updateBtn']) || isset($_POST['insertBtn'])) {
        $type = testInput($_POST['typeTxt']);
        $roomRent = testInput($_POST['roomRentTxt']);
        if (!empty($type) && !empty($roomRent)) {                   //checks if the required variables are empty
            if (isset($_POST['updateBtn'])) {
                $categoryId = testInput($_POST['hiddnId']);
                $checkTypeDuplicateQuery = "SELECT type FROM category WHERE type='$type' AND id <> '$categoryId'"; 
                $runQuery = mysql_query($checkTypeDuplicateQuery);
                if (mysql_num_rows($runQuery) == 0) {               //checks for existing type data
                    $updateQuery = "UPDATE category SET type = '$type', room_rent = '$roomRent' WHERE id = '$categoryId'";
                    $queryRunUpdate = mysql_query($updateQuery);
                    if ($queryRunUpdate) {
                        $info = TRUE; $updateSuccesInfo = 'One row successfully updated!';  }
                } else {
                    $alert = TRUE; $updateFailInfo = "$type already exists! Choose an unique 'Type'.";  
                    }
            } else {
                $checkTypeDuplicateQuery = "SELECT type FROM category WHERE type='$type'";
                $runQuery = mysql_query($checkTypeDuplicateQuery);
                if (mysql_num_rows($runQuery) == 0) {               //checks for existing type data
                    $insertQuery = "INSERT INTO category(type,room_rent) VALUES('$type', '$roomRent')";
                    $queryRunInsert = mysql_query($insertQuery);
                    if ($queryRunInsert) {
                        $info = TRUE; $insertSuccessInfo= 'One row succesfully inserted!';  
                    }
                }
                else {
                    $alert = TRUE; $insertFailInfo = "$type already exists! Choose an unique 'Type'.";
                }
            }
        }
        else {
            $alert = TRUE; $fieldNullInfo = "Field(s) can not contain empty value"; }
        }
    else if(isset($_POST['deleteBtn'])) {

        $categoryId = testInput($_POST['hiddnId']);
        $deleteQuery = "DELETE from category where id = '$categoryId'";

        $queryRunDelete = mysql_query($deleteQuery);
        if($queryRunDelete) { 
            $info = TRUE; $deleteSuccessInfo = 'One row succesfully deleted!';
        } else {
            $alert = TURE; $deleteFailInfo = "Failed to perform action!";
        }
    }        
}  
?>
   
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
                <h2>Room Category</h2>
                <div class="alert alert-warning fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong><i class="fa fa-warning"></i> Caution!</strong> Updating cells will result in <em>cascading</em> effect in successive table(s)
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Index</th>
                                <th>Type</th>
                                <th>Room Rent</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * from category";
                            $runQuery = mysql_query($query);
                            $count = 1;
                            while($row = mysql_fetch_array($runQuery)) {
                                echo "<tr>";
                                    echo "<form method='POST' action='roomCategory.php' autocomplete = off>";
                                    echo "<td>".$count."</td>";
                                    echo "<td><input type='text' class='form-control' name='typeTxt' value='".$row['type']."' data-toggle='tooltip' title= 'Type must be unique' required></td>";
                                    echo "<td><input type='number' class='form-control' name='roomRentTxt' value='".$row['room_rent']."' required></td>";
                                    echo "<td class='text-center'><button type='submit' name='updateBtn' class='btn btn-primary btn-sm'> <i class='fa fa-refresh'></i> Update </button> ";
                                    echo "<button Onclick='return ConfirmDelete();' type='submit' name='deleteBtn' value='Delete' class='btn btn-danger btn-sm'> <i class='fa fa-remove'></i> Delete </button>";
                                    echo "<input type='hidden' name='hiddnId' value='".$row['id']."'></td>";
                                    echo "</form>";
                               $count++;
                            echo "</tr>";
                            }
                            echo "<tr>";
                                    echo "<form method='POST' action='roomCategory.php' autocomplete = off>";
                                    echo "<td>" . $count . "</td>";
                                    echo "<td><input type='text' class='form-control' name='typeTxt' autofocus></td>";
                                    echo "<td><input type='number' class='form-control' name='roomRentTxt'></td>";
                                    echo "<td class = 'text-center'><button type='submit' name='insertBtn' class='btn btn-success btn-md'><i class='fa fa-plus'></i> Insert </button></td>";
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