<?php
    header('Content-Type: text/html; charset=UTF-8');
    header("Access-Control-Allow-Origin: *");
    
    $username="catherine";
    $password="@AxzGH1Y77!";
    $database="vancouver_togo";
   
    $connection=mysqli_connect ('localhost', $username, $password);
    ini_set('display_errors', 1);

    mysqli_set_charset($connection, "utf8");
    
    if (!$connection) {
      die('Not connected : ' . mysqli_error());
    }
    
    $db_selected = mysqli_select_db($connection, $database);
    if (!$db_selected) {
      die ('Can\'t use db : ' . mysqli_error());
    }

?>