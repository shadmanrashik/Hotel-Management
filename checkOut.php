<?php
    include 'header.php';
    $query = "SELECT * FROM client,book_room WHERE client.id=client_id AND check_out_date>='$today'";
                        //console.log($query);
                        $runQuery = mysql_query($query);
                        $queryNumberOfRows = mysql_num_rows($runQuery);
?>      

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Check <small>Out</small> <i class="fa fa-fw fa-sign-out pull-right"></i>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-sign-out"></i> Check Out
                            </li>
                        </ol>
                    </div>
                </div>
                <h2 class="well well-lg"> Currently Staying <span class="label label-default"><?php if(isset($queryNumberOfRows)){echo $queryNumberOfRows;} else {echo '0';}?></span> </h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th> Index </th>
                                <th> First Name </th>
                                <th> Last Name </th>
                                <th> Room Number </th>
                                <th> Check In Date </th>
                                <th> Check Out Date </th>
                                <th class="text-center"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        
                        $count = 1;
                        while ($row = mysql_fetch_array($runQuery)){
                            echo "<tr>";
                                echo "<td>" . $count . "</td>";
                                echo "<td>".$row['first_name']. "</td>";
                                echo "<td>".$row['last_name']. "</td>";
                                echo "<td>".$row['room_number']. "</td>";
                                echo "<td>".$row['check_in_date']. "</td>";
                                echo "<td>".$row['check_out_date']. "</td>";
                                echo "<td class='text-center'><button type='submit' name='checkOutBtn' class='btn btn-primary btn-sm'> <i class='fa fa-sign-out'></i> Check Out </button></td>";
                                echo "</form>";
                            echo "<tr>";
                            $count++;
                        } ?>
                        </tbody>
                    </table>
                </div>
                
                <h2 class="well well-lg"> History </h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th> Index </th>
                                <th> First Name </th>
                                <th> Last Name </th>
                                <th> Room Number </th>
                                <th> Check In Date </th>
                                <th> Check Out Date </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM client,book_room WHERE client.id=client_id AND check_out_date<'$today'";
                        //console.log($query);
                        $runQuery = mysql_query($query);
                        $count = 1;
                        while ($row = mysql_fetch_array($runQuery)){
                            echo "<tr>";
                                echo "<td>" . $count . "</td>";
                                echo "<td>".$row['first_name']. "</td>";
                                echo "<td>".$row['last_name']. "</td>";
                                echo "<td>".$row['room_number']. "</td>";
                                echo "<td>".$row['check_in_date']. "</td>";
                                echo "<td>".$row['check_out_date']. "</td>";
                                echo "</form>";
                            echo "<tr>";
                            $count++;
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


<?php
    include 'footer.php';
?>