<?php
    include 'header.php';
?>      

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dashboard <small>Today</small> <i class="fa fa-fw fa-dashboard pull-right"></i>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                
                <h2 class="well text-center">Search Room</h2>
                <h2> Available Rooms </h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th> Index </th>
                                <th> Room Type </th>
                                <th> Room Number </th>
                                <th class="text-center"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * FROM room,category WHERE room.type=category.id AND number NOT IN (SELECT room_number from book_room WHERE check_out_date >= '$today') ORDER BY room.number";
                        //console.log($query);
                        $runQuery = mysql_query($query);
                        $count = 1;
                        $query1 = "SELECT * FROM category";     
                        $runQuery1 = mysql_query($query1);
                        while ($row = mysql_fetch_array($runQuery)){
                            echo "<tr>";
                                echo "<td>" . $count . "</td>";
                                echo "<td>".$row['type']."</td>";
                                echo "<form method='GET' action='checkIn.php'>";
                                echo "<td> ".$row['number']." </td>";
                                echo "<input type='hidden' name='hiddenRoomNumber' value='".$row['number']."'>";
                                echo "<td class='text-center'><button type='submit' name='checkInBtn' class='btn btn-primary btn-sm'> <i class='fa fa-sign-in'></i> Check In </button></td>";
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