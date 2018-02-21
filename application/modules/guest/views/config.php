<?php
  /****** Database Details *********/
    $host      = "localhost";
    $user      = "root";
    $pass      = "";
    $database  = "egsmecwc_wyze_db";
   // $con       = mysql_connect($host,$user,$pass);
    $con       =  mysqli_connect($host, $user,$pass, $database);
    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }
    //echo 'Connected successfully';
  //  mysql_select_db($database,$con);
    /*******************************/
?>