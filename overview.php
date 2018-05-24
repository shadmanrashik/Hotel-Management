<?php
    include 'header.php';
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
<!--                <div class="row">-->
<h2> Room Category <button type="button" class="btn btn-success pull-right" id="category"><i class="fa fa-gear"></i> Edit Table</button></h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="categoryTablePreview">
                            <thead>
                                <tr>
                                    <th>Index</th>
                                    <th>Type</th>
                                    <th>Room Rent </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * from category ORDER BY type";
                                $runQuery = mysql_query($sql);
                                $count = 1;
                                while($row = mysql_fetch_array($runQuery)) {
                                    echo "<tr>";
                                        echo "<td>" .$count. "</td>";
                                        echo "<td>" .$row['type']. "</td>";
                                        echo "<td>" .$row['room_rent']. "</td>";
                                    $count++;
                                echo "</tr>";
                                }?>
                            </tbody>
                        </table>
                    </div>  
                <!--</div>-->
<!--                <div class="row">-->
                    <h2> Room Management <button type="button" class="btn btn-success pull-right" id="management"><i class="fa fa-gear"></i> Edit Table</button></h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped" id="categoryTablePreview">
                            <thead>
                                <tr>
                                    <th>Index</th>
                                    <th>Room Number</th>
                                    <th>Room Type</th>
                                    <th>Room Name</th>
                                    <th>Room Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * from room ORDER BY number";
                                $runQuery = mysql_query($sql);
                                $count = 1;
                                while($row = mysql_fetch_array($runQuery)) {
                                    $sqlType = "SELECT type from category WHERE id=".$row['type']."";
                                    $runQueryType = mysql_query($sqlType);
                                    $categoryToRoomQuery = mysql_fetch_array($runQueryType);
                                    echo "<tr>";
                                        echo "<td>" .$count. "</td>";
                                        echo "<td>" .$row['number']. "</td>";
                                        echo "<td>" .$categoryToRoomQuery['type']. "</td>";
                                        echo "<td>" .$row['name']. "</td>";
                                        echo "<td>" .$row['description']. "</td>";
                                    $count++;
                                echo "</tr>";
                                }?>
                            </tbody>
                        </table>
<!--                    </div>  -->
                </div>
            </div>

    <script>
        var btn1 = document.getElementById('category'), btn2 = document.getElementById('management');
        btn1.addEventListener('click', function() {
            document.location.href = '<?php echo "roomCategory.php"; ?>';
        });
        btn2.addEventListener('click', function() {
            document.location.href = '<?php echo "roomManagement.php"; ?>';
        });
    </script>
<?php
    include 'footer.php';
?>