<?php
    include 'db.php';
    ini_set('display_errors', 1);
    $typeOfDisplay = $_POST['type'];
    $city = $_POST['city'];
    
    if ($typeOfDisplay == "all") {
        $results = $connection->query("SELECT Main.*, Contacts.*, Options.*, Locations.* FROM Main INNER JOIN Contacts ON (SUBSTRING(Main.restaurant_id, 1,3) = '".$city."' AND Main.restaurant_id = Contacts.restaurant_id_4) INNER JOIN Options ON (Main.restaurant_id = Options.restaurant_id_2) INNER JOIN Locations ON (Main.restaurant_id = Locations.restaurant_id_3)");
    } else if ($typeOfDisplay == "chinese") {
        $results = $connection->query("select Main.*, Locations.*, Options.*, Contacts.* from Main 
                                     INNER JOIN ( 
                                                select * from Contacts where restaurant_id_4 in 
                                                (select restaurant_id_5 from Keywords where tagID_2 in ('chse7'))) as K 
                                     ON (Main.restaurant_id = K.restaurant_id_4 AND (SUBSTRING(Main.restaurant_id, 1,3) = '".$city."'))
                                     INNER JOIN Locations ON Locations.restaurant_id_3 = Main.restaurant_id 
                                     INNER JOIN Options ON Options.restaurant_id_2 = Main.restaurant_id 
                                     INNER JOIN Contacts ON Contacts.restaurant_id_4 = Main.restaurant_id
                                     ORDER BY `Main`.`name` ASC");
    } else if ($typeOfDisplay == "indian") {
        $results = $connection->query("select Main.*, Locations.*, Options.*, Contacts.* from Main 
                                 INNER JOIN ( 
                                            select * from Contacts where restaurant_id_4 in 
                                            (select restaurant_id_5 from Keywords where tagID_2 in ('inan6'))) as K 
                                 ON (Main.restaurant_id = K.restaurant_id_4 AND (SUBSTRING(Main.restaurant_id, 1,3) = '".$city."'))
                                 INNER JOIN Locations ON Locations.restaurant_id_3 = Main.restaurant_id 
                                 INNER JOIN Options ON Options.restaurant_id_2 = Main.restaurant_id 
                                 INNER JOIN Contacts ON Contacts.restaurant_id_4 = Main.restaurant_id
                                 ORDER BY `Main`.`name` ASC");
    } else if ($typeOfDisplay == "cafe-coffee") {
        $results = $connection->query("select Main.*, Locations.*, Options.*, Contacts.* from Main 
                                 INNER JOIN ( 
                                            select * from Contacts where restaurant_id_4 in 
                                            (select restaurant_id_5 from Keywords where tagID_2 in ('cafe4', 'coee6', 'teea3'))) as K 
                                 ON (Main.restaurant_id = K.restaurant_id_4 AND (SUBSTRING(Main.restaurant_id, 1,3) = '".$city."'))
                                 INNER JOIN Locations ON Locations.restaurant_id_3 = Main.restaurant_id 
                                 INNER JOIN Options ON Options.restaurant_id_2 = Main.restaurant_id 
                                 INNER JOIN Contacts ON Contacts.restaurant_id_4 = Main.restaurant_id
                                 ORDER BY `Main`.`name` ASC");
    } else if ($typeOfDisplay == "dessert-bakery") {
        $results = $connection->query("select Main.*, Locations.*, Options.*, Contacts.* from Main 
					                                 INNER JOIN ( 
					                                            select * from Contacts where restaurant_id_4 in 
					                                            (select restaurant_id_5 from Keywords where tagID_2 in ('buea10', 'cake4', 'dets8', 
					                                            'icam9', 'baes8', 'bals6', 'bary6'))) as K 
					                                 ON (Main.restaurant_id = K.restaurant_id_4 AND (SUBSTRING(Main.restaurant_id, 1,3) = '".$city."'))
					                                 INNER JOIN Locations ON Locations.restaurant_id_3 = Main.restaurant_id 
					                                 INNER JOIN Options ON Options.restaurant_id_2 = Main.restaurant_id 
					                                 INNER JOIN Contacts ON Contacts.restaurant_id_4 = Main.restaurant_id
					                                 ORDER BY `Main`.`name` ASC");
    } else if ($typeOfDisplay == "brewery") {
        $results = $connection->query("select Main.*, Locations.*, Options.*, Contacts.* from Main 
                                     INNER JOIN ( 
                                                select * from Contacts where restaurant_id_4 in 
                                                (select restaurant_id_5 from Keywords where tagID_2 in ('bres9'))) as K 
                                     ON (Main.restaurant_id = K.restaurant_id_4 AND (SUBSTRING(Main.restaurant_id, 1,3) = '".$city."'))
                                     INNER JOIN Locations ON Locations.restaurant_id_3 = Main.restaurant_id 
                                     INNER JOIN Options ON Options.restaurant_id_2 = Main.restaurant_id 
                                     INNER JOIN Contacts ON Contacts.restaurant_id_4 = Main.restaurant_id
                                     ORDER BY `Main`.`name` ASC");
    } else if ($typeOfDisplay == "japanese") {
        $results = $connection->query("select Main.*, Locations.*, Options.*, Contacts.* from Main 
                         INNER JOIN ( 
                                    select * from Contacts where restaurant_id_4 in 
                                    (select restaurant_id_5 from Keywords where tagID_2 in ('jase8', 'suhi5'))) as K 
                         ON (Main.restaurant_id = K.restaurant_id_4 AND (SUBSTRING(Main.restaurant_id, 1,3) = '".$city."'))
                         INNER JOIN Locations ON Locations.restaurant_id_3 = Main.restaurant_id 
                         INNER JOIN Options ON Options.restaurant_id_2 = Main.restaurant_id 
                         INNER JOIN Contacts ON Contacts.restaurant_id_4 = Main.restaurant_id
                         ORDER BY `Main`.`name` ASC");
    } else if ($typeOfDisplay == "southeast-asian") {
        $results = $connection->query("select Main.*, Locations.*, Options.*, Contacts.* from Main 
                         INNER JOIN ( 
                                    select * from Contacts where restaurant_id_4 in 
                                    (select restaurant_id_5 from Keywords where tagID_2 in ('inan10', 'maan9', 'thai4', 'vise10', 'fino8', 'sian11'))) as K 
                         ON (Main.restaurant_id = K.restaurant_id_4 AND (SUBSTRING(Main.restaurant_id, 1,3) = '".$city."'))
                         INNER JOIN Locations ON Locations.restaurant_id_3 = Main.restaurant_id 
                         INNER JOIN Options ON Options.restaurant_id_2 = Main.restaurant_id 
                         INNER JOIN Contacts ON Contacts.restaurant_id_4 = Main.restaurant_id
                         ORDER BY `Main`.`name` ASC");
    } else if ($typeOfDisplay == "latin") {
        $results = $connection->query("select Main.*, Locations.*, Options.*, Contacts.* from Main 
                         INNER JOIN ( 
                                    select * from Contacts where restaurant_id_4 in 
                                    (select restaurant_id_5 from Keywords where tagID_2 in ('mean7', 'caan9', 'cuan5', 'lan 6', 'pean8'))) as K 
                         ON (Main.restaurant_id = K.restaurant_id_4 AND (SUBSTRING(Main.restaurant_id, 1,3) = '".$city."'))
                         INNER JOIN Locations ON Locations.restaurant_id_3 = Main.restaurant_id 
                         INNER JOIN Options ON Options.restaurant_id_2 = Main.restaurant_id 
                         INNER JOIN Contacts ON Contacts.restaurant_id_4 = Main.restaurant_id
                         ORDER BY `Main`.`name` ASC");
    } else if ($typeOfDisplay == "italian") {
        $results = $connection->query("select Main.*, Locations.*, Options.*, Contacts.* from Main 
                         INNER JOIN ( 
                                    select * from Contacts where restaurant_id_4 in 
                                    (select restaurant_id_5 from Keywords where tagID_2 in ('itan7', 'pata5'))) as K 
                         ON (Main.restaurant_id = K.restaurant_id_4 AND (SUBSTRING(Main.restaurant_id, 1,3) = '".$city."'))
                         INNER JOIN Locations ON Locations.restaurant_id_3 = Main.restaurant_id 
                         INNER JOIN Options ON Options.restaurant_id_2 = Main.restaurant_id 
                         INNER JOIN Contacts ON Contacts.restaurant_id_4 = Main.restaurant_id
                         ORDER BY `Main`.`name` ASC");
    } else if ($typeOfDisplay == "euro") {
        $results = $connection->query("select Main.*, Locations.*, Options.*, Contacts.* from Main 
                         INNER JOIN ( 
                                    select * from Contacts where restaurant_id_4 in 
                                    (select restaurant_id_5 from Keywords where tagID_2 in ('euan8', 'bean7', 'itan7', 'frch6', 'grek5'))) as K 
                         ON (Main.restaurant_id = K.restaurant_id_4 AND (SUBSTRING(Main.restaurant_id, 1,3) = '".$city."'))
                         INNER JOIN Locations ON Locations.restaurant_id_3 = Main.restaurant_id 
                         INNER JOIN Options ON Options.restaurant_id_2 = Main.restaurant_id 
                         INNER JOIN Contacts ON Contacts.restaurant_id_4 = Main.restaurant_id
                         ORDER BY `Main`.`name` ASC");
    } else if ($typeOfDisplay == "med-mid") {
        $results = $connection->query("select Main.*, Locations.*, Options.*, Contacts.* from Main 
                         INNER JOIN ( 
                                    select * from Contacts where restaurant_id_4 in 
                                    (select restaurant_id_5 from Keywords where tagID_2 in ('aran7', 'lese8', 'mean13', 'mirn14', 'grek5'))) as K 
                         ON (Main.restaurant_id = K.restaurant_id_4 AND (SUBSTRING(Main.restaurant_id, 1,3) = '".$city."'))
                         INNER JOIN Locations ON Locations.restaurant_id_3 = Main.restaurant_id 
                         INNER JOIN Options ON Options.restaurant_id_2 = Main.restaurant_id 
                         INNER JOIN Contacts ON Contacts.restaurant_id_4 = Main.restaurant_id
                         ORDER BY `Main`.`name` ASC");
    } else if ($typeOfDisplay == "comfort") {
        $results = $connection->query("select Main.*, Locations.*, Options.*, Contacts.* from Main 
                         INNER JOIN ( 
                                    select * from Contacts where restaurant_id_4 in 
                                    (select restaurant_id_5 from Keywords where tagID_2 in ('aman8', 'bbq3', 'baue8', 'buer6', 'cood12', 'dier5', 'faod9', 'piza5', 'wrps5'))) as K 
                         ON (Main.restaurant_id = K.restaurant_id_4 AND (SUBSTRING(Main.restaurant_id, 1,3) = '".$city."'))
                         INNER JOIN Locations ON Locations.restaurant_id_3 = Main.restaurant_id 
                         INNER JOIN Options ON Options.restaurant_id_2 = Main.restaurant_id 
                         INNER JOIN Contacts ON Contacts.restaurant_id_4 = Main.restaurant_id
                         ORDER BY `Main`.`name` ASC");
    } else if ($typeOfDisplay == "east-asian") {
        $results = $connection->query("select Main.*, Locations.*, Options.*, Contacts.* from Main 
                         INNER JOIN ( 
                                    select * from Contacts where restaurant_id_4 in 
                                    (select restaurant_id_5 from Keywords where tagID_2 in ('chse7', 'jase8', 'suhi5', 'inan10', 'maan9', 'thai4', 'vise10', 'fino8', 'sian11', 'koan6'))) as K 
                         ON (Main.restaurant_id = K.restaurant_id_4 AND (SUBSTRING(Main.restaurant_id, 1,3) = '".$city."'))
                         INNER JOIN Locations ON Locations.restaurant_id_3 = Main.restaurant_id 
                         INNER JOIN Options ON Options.restaurant_id_2 = Main.restaurant_id 
                         INNER JOIN Contacts ON Contacts.restaurant_id_4 = Main.restaurant_id
                         ORDER BY `Main`.`name` ASC");
    } else if ($typeOfDisplay == "bar-pub") {
        $results = $connection->query("select Main.*, Locations.*, Options.*, Contacts.* from Main 
                 INNER JOIN ( 
                            select * from Contacts where restaurant_id_4 in 
                            (select restaurant_id_5 from Keywords where tagID_2 in ('baod8','puub3'))) as K 
                 ON (Main.restaurant_id = K.restaurant_id_4 AND (SUBSTRING(Main.restaurant_id, 1,3) = '".$city."'))
                 INNER JOIN Locations ON Locations.restaurant_id_3 = Main.restaurant_id 
                 INNER JOIN Options ON Options.restaurant_id_2 = Main.restaurant_id 
                 INNER JOIN Contacts ON Contacts.restaurant_id_4 = Main.restaurant_id
                 ORDER BY `Main`.`name` ASC");
    } else if ($typeOfDisplay == "canadian") {
        $results = $connection->query("select Main.*, Locations.*, Options.*, Contacts.* from Main 
                         INNER JOIN ( 
                                    select * from Contacts where restaurant_id_4 in 
                                    (select restaurant_id_5 from Keywords where tagID_2 in ('aman8', 'caan8', 'dier5'))) as K 
                         ON (Main.restaurant_id = K.restaurant_id_4 AND (SUBSTRING(Main.restaurant_id, 1,3) = '".$city."'))
                         INNER JOIN Locations ON Locations.restaurant_id_3 = Main.restaurant_id 
                         INNER JOIN Options ON Options.restaurant_id_2 = Main.restaurant_id 
                         INNER JOIN Contacts ON Contacts.restaurant_id_4 = Main.restaurant_id
                         ORDER BY `Main`.`name` ASC");
    } else if ($typeOfDisplay == "asian") {
        $results = $connection->query("select Main.*, Locations.*, Options.*, Contacts.* from Main 
                         INNER JOIN ( 
                                    select * from Contacts where restaurant_id_4 in 
                                    (select restaurant_id_5 from Keywords where tagID_2 in ('asan5'))) as K 
                         ON (Main.restaurant_id = K.restaurant_id_4 AND (SUBSTRING(Main.restaurant_id, 1,3) = '".$city."'))
                         INNER JOIN Locations ON Locations.restaurant_id_3 = Main.restaurant_id 
                         INNER JOIN Options ON Options.restaurant_id_2 = Main.restaurant_id 
                         INNER JOIN Contacts ON Contacts.restaurant_id_4 = Main.restaurant_id
                         ORDER BY `Main`.`name` ASC");
    } else if ($typeOfDisplay == "seafood") {
        $results = $connection->query("select Main.*, Locations.*, Options.*, Contacts.* from Main 
                         INNER JOIN ( 
                                    select * from Contacts where restaurant_id_4 in 
                                    (select restaurant_id_5 from Keywords where tagID_2 in ('seod7'))) as K 
                         ON (Main.restaurant_id = K.restaurant_id_4 AND (SUBSTRING(Main.restaurant_id, 1,3) = '".$city."'))
                         INNER JOIN Locations ON Locations.restaurant_id_3 = Main.restaurant_id 
                         INNER JOIN Options ON Options.restaurant_id_2 = Main.restaurant_id 
                         INNER JOIN Contacts ON Contacts.restaurant_id_4 = Main.restaurant_id
                         ORDER BY `Main`.`name` ASC");
    }
    
    displayRestaurants($results);
    
	function displayRestaurants($result) {
		$rowCheck = 1;
		if ($result -> num_rows > 0) {
			while ($row = mysqli_fetch_array($result)) {
				if (($rowCheck-1) % 3 == 0) {
					echo '<div class="row" id="restaurantrow">';
				}
				echo '<div class="column" id="restaurantcolumn">';
				echo "<p>".$row[("name")]."</p>";
				echo '<div class="restaurant-options">'.'<span class="classification">'; 
	                        	
	            if ($row["gf"] == 'Y') {
	                echo '<img src="images/gluten-free.svg" alt="Gluten-free options">';
	     		}
	    		if ($row["veg"] == 'Y') {
	                echo '<img src="images/leaf.svg" alt="Vegetarian/vegan options">';
	            }
	            if ($row["delivery"] == 'Y') {
	                 echo '<img src="images/meal.svg" alt="Delivery available">';
	           	}
	            if ($row["pickup"] == 'Y') {
	                echo '<img src="images/letter-p.svg" alt="Safe pick-up">';
	            }
	                        	
	            echo '</span>'.'</div>';
				echo "<p>"."<br>". $row["address"]."<br>".$row["hours"]."<br>";
								
				if (!empty($row["phone"])) {
					echo $row["phone"]. "<br>";
				}

				if (!empty($row["website"])) {
					if(strpos($row["website"], "facebook")) {
						echo '<a href="https://'.$row["website"].'">'.'Visit their Facebook page'.'</a><br>';
					} else {
						echo '<a href="http://'.$row["website"].'">'.preg_replace("/www./", "", rtrim($row["website"], '/')).'</a><br>';
					}
				}					
								
				if (!empty($row["discounts"])) {
					echo '<p><u>'.$row["discounts"].'</u></p>';
				}
				
				$queryLocation = preg_replace('/\s+/', '+', $row["name"]).'@'.$row["address"];
								
				echo "</p>".'<div class="map"><a href="https://www.google.com/maps/search/?api=1&query='.$queryLocation.'"><img src="images/location.svg"></a></div>'."</div>";

				if ($rowCheck % 3 == 0) {
					echo "</div>";
				}
				
				$rowCheck++;
			}
		} else {
			echo '<center>'.'No results found'.'</center>';
		}
	}
	