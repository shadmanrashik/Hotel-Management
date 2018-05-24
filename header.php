<?php
    require 'database/connect.php';
    require 'database/core.php';

    if(!loggedin()) {
        header('Location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hotel Management</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Hotel Management</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php getUserName();?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="<?php if($fileName == '/HotelManagement/index.php'){ echo 'active'; }?>">
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>

                    <li class="<?php if($fileName == '/HotelManagement/checkOut.php'){ echo 'active'; }?>">
                        <a href="checkOut.php"><i class="fa fa-fw fa-sign-out"></i> Check Out</a>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-th-large"></i> Admin Customization <i class="fa fa-fw fa-caret-up"></i></a>
                        <ul id="demo" class="collapse in">
                            <li>
                                <a href="overview.php"><i class="fa fa-fw fa-desktop"></i> Overview </a>
                            </li>
                            <li class="">
                                <a href="roomCategory.php"><i class="fa fa-fw fa-bar-chart-o"></i> Room Category </a>
                            </li>
                            <li>
                                <a href="roomManagement.php"><i class="fa fa-fw fa-wrench"></i> Room Management</a>
                            </li>
                            <li>
                                <a href="employeeSignUp.php"><i class="fa fa-fw fa-user"></i> Employee Sign Up </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if($fileName == '/HotelManagement/contactUs.php'){ echo 'active'; }?>">
                        <a href="contactUs.php"><i class="fa fa-fw fa-comment"></i> About Us</a>
                    </li>
                </ul>
            </div>
        </nav>
<!-- /.navbar-collapse -->