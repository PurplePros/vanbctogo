<?php
    header('Content-Type: text/html; charset=utf-8');
    $username="catherine";
    $password="@AxzGH1Y77!";
    $database="vancouver_togo";
    ini_set('display_errors', 1);

    
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        $inputJSON = file_get_contents('php://input');
        
        $data = json_decode( $inputJSON ); 
        
        // var_dump($inputJSON);
        // var_dump($data);
        
        $connection=mysqli_connect ('localhost', $username, $password);

        if (!$connection) {
          die('Not connected : ' . mysqli_error());
        }
        
        $db_selected = mysqli_select_db($connection, $database);
        if (!$db_selected) {
          die ('Can\'t use db : ' . mysqli_error());
        }
        
        $restaurant_id = $data->RestaurantID;
        
        // echo $restaurant_id;
        
        $lat = $data->Lat;
        
        // echo $lat;
        
        $lng = $data->Lng;
        
        // echo $lng;
        
        $query = "UPDATE Locations SET longitude =".$lng.", latitude = ".$lat." WHERE restaurant_id_3 = '".$restaurant_id."';";
        
        // echo $query; 
        
        mysqli_query($connection, $query);
    }
?>
