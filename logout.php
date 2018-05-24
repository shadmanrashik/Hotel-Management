<?php
//require 'database/core.inc.php';
//echo $http_referer;
session_start();
//echo  $_SESSION['userid'];
//exit();
session_destroy();
header('Location: login.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

