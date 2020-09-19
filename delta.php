<?php
    include 'db.php';
    
    $query = "SELECT Main.*, Contacts.*, Options.*, Locations.*, busyness.*
                FROM Main INNER JOIN Contacts ON (SUBSTRING(Main.restaurant_id, 1,3) = 'del' AND Main.restaurant_id = Contacts.restaurant_id_4) 
                INNER JOIN Options ON (Main.restaurant_id = Options.restaurant_id_2) 
                INNER JOIN Locations ON (Main.restaurant_id = Locations.restaurant_id_3)
                INNER JOIN busyness ON (Main.restaurant_id = busyness.restaurant_id_6)";
    
    $result = mysqli_query($connection, $query);
    if (!$result) {
      die('Invalid query: ' . mysqli_error());
    }
    
    $count = 0;
    $id = array();
    $name = array();
    $address = array();
    $hours = array();
    $phone = array();
    $website = array();
    $postalcode = array();
    $veg = array();
    $gf = array();
    $pickup = array();
    $delivery = array();
    $longitude = array();
    $latitude = array();
    $busyness = array(); 
    $busyness_type = array();
    
    while ($row = @mysqli_fetch_assoc($result)){
        $id[] = $row["restaurant_id"];
        $name[] = $row["name"];
        $address[] = $row["address"];
        $postalcode[] = $row["postal_code"];
        $hours[] = $row["hours"];
        $website[] = $row["website"];
        $veg[] = $row["veg"];
        $gf[] = $row["gf"];
        $pickup[] = $row["pickup"];
        $delivery[] = $row["delivery"];
        $phone[] = $row["phone"];
        $longitude[] = $row["longitude"];
        $latitude[] = $row["latitude"];
        $busyness[] = $row["busyness"];
        $busyness_type[] = $row["data_type"];
    }
?>

<!doctype html>
<html lang="en">
	<head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-171539242-2"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'UA-171539242-2');
        </script>  
		<title>Delta listing</title>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta prefix="og: http://ogp.me/ns#" property="og:title" content="Find your next food destination">
	    <meta prefix="og: http://ogp.me/ns#" property="og:description" content="A map listing of local restaurants in British Columbia. Get information about restaurant offerings in your area for your next takeout, or stay up-to-date on live restaurant capacity for safe dine-ins.">
	    <meta prefix="og: http://ogp.me/ns#" property="og:image" content="https://vanbctogo.ca/images/card-min.jpg">
	    <meta prefix="og: http://ogp.me/ns#" property="og:url" content="https://vanbctogo.ca/index.html">
	    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
    	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&family=Roboto:wght@300;400&display=swap" rel="stylesheet">
	    <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">
	    <link href="style.css" type="text/css" rel="stylesheet" media="screen"/>
	    <script src="onloadscript.js"></script>
	</head>
	<body>
		<header>
			<nav class="navbar navbar-expand-lg navbar-light bg-white">
				<a href="index.html">
    				<span class="navbar-brand mb-2 p-2" id="navbar-header">
    					<h1>VANBCTOGO</h1>
    					<h6>Find your next food destination</h6>
    				</span>
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item" id="navbar-link">
					        <a class="nav-link" href="index.html">HOME<span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              LOCAL GUIDE
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="vancouver.php">Vancouver</a>
                                <a class="dropdown-item" href="richmond.php">Richmond</a>
                                <a class="dropdown-item active" href="delta.php">Delta</a>
                                <a class="dropdown-item" href="northvan.php">North Vancouver</a>
                                <!--<a class="dropdown-item" href="#">Kelowna</a>-->
                                <a class="dropdown-item" href="kelowna.php">Kelowna</a>
                                <a class="dropdown-item" href="victoria.php">Victoria</a>
                            </div>
                        </li>
						<li class="nav-item" id="navbar-link">
							<a class="nav-link" href="about.html">ABOUT US</a>
						</li>
						<li class="nav-item" id="navbar-link">
							<a class="nav-link" href="contact.html">CONTACT US</a>
						</li>
						<li class="nav-item" id="navbar-link">
							<a class="nav-link" href="https://vanbctogo.ca/blog">COMMUNITY STORIES</a>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<main>
			<div class="listing">
				<h3>Local restaurants in <span class="highlightCity">DELTA</span></h3>
				<div class="popup" id="popup">
        			<div class="overlay"></div>
        			<div class="content">
        				<div class="close-btn" onclick="togglePopup()">&times;</div>
        				<div class="modal-header">
        					<p>How to use the map?</p>
        				</div>
        				<div class="modal-body">
        					<div class="modal-subheader">
        						<p>Restaurant Offering Icons</p>
        					</div>
        					<div class="container">
        						<div class="row justify-content-around">
        	                        <div class="col-sm text-center">
        	                            <span class="legend-icon">
        	                                <img src="images/gluten-free.svg" alt="Gluten-free options">
        	                                <p>Gluten-free</p>
        	                            </span>
        	                        </div>
        	                        <div class="col-sm text-center">
        	                            <span class="legend-icon">
        	                                <img src="images/leaf.svg" alt="Vegetarian/vegan options">
        	                                <p>Vegetarian/vegan</p>
        	                            </span>
        	                        </div>
        	                        <div class="col-sm text-center">
        	                            <span class="legend-icon">
        	                                <img src="images/meal.svg" alt="Delivery">
        	                                <p>Delivery</p>
        	                            </span>
        	                        </div>
        	                        <div class="col-sm text-center">
        	                            <span class="legend-icon">
        	                                <img src="images/letter-p.svg" alt="Safe pick-up">
        	                                <p>Pick-up</p>
        	                            </span>
        	                        </div>
                            	</div>
        					</div>
        					<p></p>
        					<div class="modal-subheader">
        						<p>Map Marker Icons</p>
        					</div>
        					<div class="container">
        						<div class="row justify-content-around">
        							<div class="col-sm text-center">
        								<span class="legend-marker">
        									<img src="http://maps.google.com/mapfiles/ms/icons/green-dot.png" alt="Green marker">
        									<p>Not crowded<br>0-25% capacity</p>
        								</span>
        							</div>
        							<div class="col-sm text-center">
        								<span class="legend-marker">
        									<img src="http://maps.google.com/mapfiles/ms/icons/yellow-dot.png" alt="Yellow marker">
        									<p>Slightly crowded<br>25-50% capacity</p>
        								</span>
        							</div>
        							<div class="col-sm text-center">
        								<span class="legend-marker">
        									<img src="http://maps.google.com/mapfiles/ms/icons/orange-dot.png" alt="Orange marker">
        									<p>Moderately crowded<br>50-75% capacity</p>
        								</span>
        							</div>
        							<div class="col-sm text-center">
        								<span class="legend-marker">
        									<img src="http://maps.google.com/mapfiles/ms/icons/red-dot.png" alt="Red marker">
        									<p>Very crowded<br>75+% capacity</p>
        								</span>
        							</div>
        							<div class="col-sm text-center">
        								<span class="legend-marker">
        									<img src="http://labs.google.com/ridefinder/images/mm_20_gray.png" alt="Gray marker">
        									<p>Capacity information not available</p>
        								</span>
        							</div>
        							<div class="col-sm text-center">
        								<span class="legend-marker">
        									<img src="http://maps.google.com/mapfiles/ms/icons/blue-dot.png" alt="Blue marker">
        									<p>Colour displayed when capacity is toggled off</p>
        								</span>
        							</div>
        						</div>
        					</div>
        				</div>
        			</div>
		        </div>
                <p></p>
                <div class="viewOptions">
                    <button onClick="displayMap()" class="filterBtn">View Interactive Map</button>
    	            <button onClick="displayListing()" class="filterBtn">View Listing</button>
                </div>
                <p></p>
                <div class="interactiveMap">
                    <div class="panel">
                    </div>
                    <div id="map"></div>
                </div>
                <div class="placesList">
    	            <div class= "filter">
        	            <div class="d-flex flex-wrap justify-content-center">
        	                <button class="filterButtons" id="cafe-coffee">Cafe/Coffee Shop</button>
        	                <button class="filterButtons" id="indian">Indian</button>
        	                <button class="filterButtons" id="chinese">Chinese</button>
        	                <button class="filterButtons" id="japanese">Japanese</button>
        	                <button class="filterButtons" id="italian">Italian</button>
        	                <button class="filterButtons" id="med-mid">Mediterranean</button>
        	                <button class="filterButtons" id="bar-pub">Bar/Pub Fare</button>
        	                <button class="filterButtons" id="viewall">View All</button>
        	            </div>
        	        </div>
                    <div class="container">
                        <div class="row justify-content-around" id="legend">
                            <div class="col-sm text-center">
                                <span class="classification">
                                    <img src="images/gluten-free.svg" alt="Gluten-free options">
                                    <p>Gluten-free</p>
                                </span>
                            </div>
                            <div class="col-sm text-center">
                                <span class="classification">
                                    <img src="images/leaf.svg" alt="Vegetarian/vegan options">
                                    <p>Vegetarian/vegan</p>
                                </span>
                            </div>
                            <div class="col-sm text-center">
                                <span class="classification">
                                    <img src="images/meal.svg" alt="Delivery">
                                    <p>Delivery</p>
                                </span>
                            </div>
                            <div class="col-sm text-center">
                                <span class="classification">
                                    <img src="images/letter-p.svg" alt="Safe pick-up">
                                    <p>Pick-up</p>
                                </span>
                            </div>
                        </div>
                    </div>
    	            <hr id="short-break">
    	            <div class = "restaurants">
    	            </div>
                </div>
            </div>
		</main>
		<script type="text/javascript">
            var currentBtn; 
            
            $(document).ready(function() {
                $(".restaurants").load("displaydata.php", {
                    type: "all",
                    city: "del"
                });
            })
            
            var viewAll = document.getElementById("viewall");
            viewAll.addEventListener("click", function() {
                $(".restaurants").innerHTML = '';
                $(".restaurants").load("displaydata.php", {
                   type: "all",
                   city: "del"
                })
                if(currentBtn) {
            		currentBtn.style.backgroundColor = "black";
            	}
                viewAll.style.backgroundColor = "#4f86fe";
                currentBtn = viewAll;
            })
            
            var cafecoffeeFilter = document.getElementById("cafe-coffee");
            cafecoffeeFilter.addEventListener("click", function() {
                $(".restaurants").innerHTML = '';
                $(".restaurants").load("displaydata.php", {
                    type: "cafe-coffee",
                    city: "del"
                })
                if(currentBtn) {
            		currentBtn.style.backgroundColor = "black";
            	}
                cafecoffeeFilter.style.backgroundColor = "#4f86fe";
                currentBtn = cafecoffeeFilter;
            });
            
            var indianFilter = document.getElementById("indian");
            indianFilter.addEventListener("click", function() {
               $(".restaurants").innerHTML = '';
               $(".restaurants").load("displaydata.php", {
                   type: "indian",
                   city: "del"
               })
                if(currentBtn) {
                	currentBtn.style.backgroundColor = "black";
                }
                indianFilter.style.backgroundColor = "#4f86fe";
                currentBtn = indianFilter;
            });
            
            var chineseFilter = document.getElementById("chinese");
            chineseFilter.addEventListener("click", function() {
               $(".restaurants").innerHTML = '';
               $(".restaurants").load("displaydata.php", {
                   type: "chinese",
                   city: "del"
               })
               if(currentBtn) {
            		currentBtn.style.backgroundColor = "black";
            	}
                chineseFilter.style.backgroundColor = "#4f86fe";
                currentBtn = chineseFilter;
            });
            
            var japaneseFilter = document.getElementById("japanese");
            japaneseFilter.addEventListener("click", function() {
               $(".restaurants").innerHTML = '';
               $(".restaurants").load("displaydata.php", {
                   type: "japanese",
                   city: "del"
               })
               if(currentBtn) {
            		currentBtn.style.backgroundColor = "black";
            	}
                japaneseFilter.style.backgroundColor = "#4f86fe";
                currentBtn = japaneseFilter;
            });
            
            var italianFilter = document.getElementById("italian");
            italianFilter.addEventListener("click", function() {
               $(".restaurants").innerHTML = '';
               $(".restaurants").load("displaydata.php", {
                   type: "italian",
                   city: "del"
               })
               if(currentBtn) {
            		currentBtn.style.backgroundColor = "black";
            	}
                italianFilter.style.backgroundColor = "#4f86fe";
                currentBtn = italianFilter;
            });
            
            var medmidFilter = document.getElementById("med-mid");
            medmidFilter.addEventListener("click", function() {
               $(".restaurants").innerHTML = '';
               $(".restaurants").load("displaydata.php", {
                   type: "med-mid",
                   city: "del"
               })
               if(currentBtn) {
            		currentBtn.style.backgroundColor = "black";
            	}
                medmidFilter.style.backgroundColor = "#4f86fe";
                currentBtn = medmidFilter;
            });
            
            var barPubFilter = document.getElementById("bar-pub");
            barPubFilter.addEventListener("click", function() {
               $(".restaurants").innerHTML = '';
               $(".restaurants").load("displaydata.php", {
                   type: "bar-pub",
                   city: "del"
               })
               
              if(currentBtn) {
            		currentBtn.style.backgroundColor = "black";
            	}
                barPubFilter.style.backgroundColor = "#4f86fe";
                currentBtn = barPubFilter;
            });
            
	    </script>
        <script>
                var map;
                var delayFactor = 0;
                var geocoder;
                var markers = [];
                var side_bar_link = "";
                var ids = [];
                var names = [];
                var hours = [];
                var addresses = [];
                var phonenumbers = [];
                var websites = [];
                var postalcodes = [];
                var vegoption = [];
                var pickupoption = [];
                var gfoption = [];
                var deliveryoption = [];
                var longitudes = [];
                var latitudes = [];
                var busyness = [];
                var busynessType = [];
                
                var iconBase = 'http://maps.google.com/mapfiles/ms/icons/'
                
                var icons = {
                    "blue": {
                        icon: iconBase + 'blue-dot.png'
                    },
                    "gray": {
                        icon: 'http://labs.google.com/ridefinder/images/mm_20_gray.png'
                    },
                    "red": {
                        icon: iconBase + 'red-dot.png'
                    },    
                    "orange": {
                        icon: iconBase + 'orange-dot.png'
                    },
                    "yellow": {
                        icon: iconBase + 'yellow-dot.png'
                    },
                    "green": {
                        icon: iconBase + 'green-dot.png'
                    }
                };
                
                function initMap() {
                    ids = 
                        <?php
                            echo json_encode($id, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                        ?>;
                    names = 
                        <?php
                            echo json_encode($name, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                        ?>;
                    hours = 
                        <?php
                            echo json_encode($hours, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                        ?>;
                    addresses = 
                        <?php
                            // $out = array_values($address);
                            echo json_encode($address);
                        ?>;
                    phonenumbers =
                        <?php
                            echo json_encode($phone);
                        ?>;
                    websites = 
                        <?php
                            echo json_encode($website, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
                        ?>;
                    postalcodes = 
                        <?php
                            echo json_encode($postalcode);
                        ?>;
                    vegoption = 
                        <?php
                            echo json_encode($veg);
                        ?>;
                    gfoption = 
                        <?php
                            echo json_encode($gf);
                        ?>;
                    pickupoption = 
                        <?php
                            echo json_encode($pickup);
                        ?>;
                    deliveryoption = 
                        <?php
                            echo json_encode($delivery);
                        ?>;
                    longitudes = 
                        <?php
                            echo json_encode($longitude);
                        ?>;
                    latitudes = 
                        <?php
                            echo json_encode($latitude);
                        ?>;
                    busyness = 
                        <?php
                            echo json_encode($busyness);
                        ?>;
                    busynessType = 
                        <?php
                            echo json_encode($busyness_type);
                        ?>;
                    
                    map = new google.maps.Map(document.getElementById("map"), {
                        center: { lat: 49.0180, lng: -123.0818 },
                        zoom: 14,
                        mapTypeControl: false,
                        styles: [
                        {
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#ebe3cd"
                          }
                        ]
                      },
                      {
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#523735"
                          }
                        ]
                      },
                      {
                        "elementType": "labels.text.stroke",
                        "stylers": [
                          {
                            "color": "#f5f1e6"
                          }
                        ]
                      },
                      {
                        "featureType": "administrative",
                        "elementType": "geometry.stroke",
                        "stylers": [
                          {
                            "color": "#c9b2a6"
                          }
                        ]
                      },
                      {
                        "featureType": "administrative.land_parcel",
                        "elementType": "geometry.stroke",
                        "stylers": [
                          {
                            "color": "#dcd2be"
                          }
                        ]
                      },
                      {
                        "featureType": "administrative.land_parcel",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#ae9e90"
                          }
                        ]
                      },
                      {
                        "featureType": "landscape.natural",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#dfd2ae"
                          }
                        ]
                      },
                      {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#dfd2ae"
                          }
                        ]
                      },
                      {
                        "featureType": "poi",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#93817c"
                          }
                        ]
                      },
                      {
                        "featureType": "poi.business",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "poi.park",
                        "elementType": "geometry.fill",
                        "stylers": [
                          {
                            "color": "#a5b076"
                          }
                        ]
                      },
                      {
                        "featureType": "poi.park",
                        "elementType": "labels.text",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "poi.park",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#447530"
                          }
                        ]
                      },
                      {
                        "featureType": "road",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#f5f1e6"
                          }
                        ]
                      },
                      {
                        "featureType": "road.arterial",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#fdfcf8"
                          }
                        ]
                      },
                      {
                        "featureType": "road.highway",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#f8c967"
                          }
                        ]
                      },
                      {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [
                          {
                            "color": "#e9bc62"
                          }
                        ]
                      },
                      {
                        "featureType": "road.highway.controlled_access",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#e98d58"
                          }
                        ]
                      },
                      {
                        "featureType": "road.highway.controlled_access",
                        "elementType": "geometry.stroke",
                        "stylers": [
                          {
                            "color": "#db8555"
                          }
                        ]
                      },
                      {
                        "featureType": "road.local",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#806b63"
                          }
                        ]
                      },
                      {
                        "featureType": "transit.line",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#dfd2ae"
                          }
                        ]
                      },
                      {
                        "featureType": "transit.line",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#8f7d77"
                          }
                        ]
                      },
                      {
                        "featureType": "transit.line",
                        "elementType": "labels.text.stroke",
                        "stylers": [
                          {
                            "color": "#ebe3cd"
                          }
                        ]
                      },
                      {
                        "featureType": "transit.station",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "color": "#dfd2ae"
                          }
                        ]
                      },
                      {
                        "featureType": "water",
                        "elementType": "geometry.fill",
                        "stylers": [
                          {
                            "color": "#b9d3c2"
                          }
                        ]
                      },
                      {
                        "featureType": "water",
                        "elementType": "labels.text.fill",
                        "stylers": [
                          {
                            "color": "#92998d"
                          }
                        ]
                      }
                    ]
                    });
                var infoWindow = new google.maps.InfoWindow;
                var geocoder = new google.maps.Geocoder;
                
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var pos = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        myLoc = new google.maps.LatLng(pos.lat,pos.lng);
                        map.setCenter(pos);
                        map.setZoom(18);
                        marker = new google.maps.Marker({
                            map: map,
                            position: pos,
                            icon: 'https://www.google.com/mapfiles/arrow.png'
                        });
                    });
                }
                
                var mq = window.matchMedia( "(max-width: 600px)" )
                
                var liveControlDiv = document.createElement('div')
                liveControlDiv.style.marginTop = '10px'
                liveControlDiv.style.marginLeft = '10px'
                
                var controlUI = document.createElement('div')
                controlUI.style.backgroundColor = '#fff'
                controlUI.style.boxShadow = '2px 2px #d3d3d3'
                controlUI.style.padding = '20px'
                controlUI.style.border = '2px solid #fff'
                controlUI.style.borderRadius = '5px'
                controlUI.style.display = 'inline-block';
                controlUI.style.verticalAlign = 'middle'
                controlUI.title = 'Click to show/hide live markers';
                
                liveControlDiv.appendChild(controlUI);
                var controlCheckbox = document.createElement('input')
                controlCheckbox.type = "checkbox"
                controlCheckbox.name = "toggleLive"
                controlCheckbox.value = "on"
                controlCheckbox.id = "liveToggle"
                controlCheckbox.style.display = 'inline-block';
                controlCheckbox.style.verticalAlign = 'middle'
                controlCheckbox.style.float = 'left'
                controlUI.appendChild(controlCheckbox)
                controlCheckbox.addEventListener('change', function() {
                    if(controlCheckbox.checked) {
                        for (let i = 0; i < markers.length; i++) {
                            if (markers[i] != null) {
                                let iconNumber = getIconColour(busyness[i])
                                // console.log(names[i] + iconNumber + " " + icons[iconNumber] + " " + icons[iconNumber].icon)
                                markers[i].setIcon(icons[iconNumber].icon)
                            }
                        }
                    } else {
                        for (let i = 0; i < markers.length; i++) {
                            if (markers[i] != null) {
                                markers[i].setIcon(icons["blue"].icon)   
                            }
                        }
                    }
                })
                
                var controlText = document.createElement('div');
                controlText.style.color = 'rgb(25,25,25)';
                controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
                if (mq.matches) {
                    controlText.style.fontSize = '16px';
                    controlCheckbox.style.marginTop = '1px'
                }
                else {
                    controlText.style.fontSize = '20px';
                    controlCheckbox.style.marginTop = '5px'
                }
                controlText.style.overflow = 'hidden';
                controlText.style.display = 'inline-block';
                controlText.style.verticalAlign = 'middle'
                controlText.style.paddingLeft = '15px';
                controlText.innerHTML = 'Display restaurant capacity';
                controlUI.appendChild(controlText);
                
                var helpControlDiv = document.createElement('div')
                helpControlDiv.setAttribute('class', 'help-btn')
                helpControlDiv.style.marginLeft = '10px'
                helpControlDiv.style.marginTop = '10px'
                helpControlDiv.style.cursor = 'pointer'
                
        
                var helpUI = document.createElement('div')
                helpUI.setAttribute('class', 'help-ui')
                helpUI.style.backgroundColor = '#fff'
                helpUI.style.boxShadow = '2px 2px #d3d3d3'
                helpUI.style.padding = '5px'
                helpUI.style.border = '2px solid #fff'
                helpUI.style.borderRadius = '5px'
                helpControlDiv.appendChild(helpUI);
                
                var helpIcon = document.createElement('img')
                helpIcon.setAttribute('class', 'help-icon')
                helpIcon.style.height = '30px';
                helpIcon.style.width = '30px'; 
                helpIcon.setAttribute('src', 'https://img.icons8.com/material/48/000000/help--v1.png');
                helpUI.appendChild(helpIcon)
                
                liveControlDiv.index = 1
                helpControlDiv.index = 1
                
                if (mq.matches) {
                    map.controls[google.maps.ControlPosition.TOP_LEFT].push(liveControlDiv)
                    map.controls[google.maps.ControlPosition.LEFT_CENTER].push(helpControlDiv)
                    
                } else {
                    map.controls[google.maps.ControlPosition.TOP_LEFT].push(liveControlDiv)
                    map.controls[google.maps.ControlPosition.LEFT_TOP].push(helpControlDiv)
                }
                
                getLatLng(geocoder, map, infoWindow);
            }
            
            function getLatLng(geocoder, map, infowindow) {
                var promises = [];
                
                for (let i = 0; i < addresses.length; i++) {
                    promises.push(getGeocode(geocoder, i, infowindow).then(addSideBar(i)));
                }
                
                Promise.all(promises).then(function() {
                    document.getElementsByClassName("panel")[0].innerHTML = side_bar_link;
                })
            }
            
            function getGeocode(geocoder, i, infowindow) {
                return new Promise(function(resolve) {
                    var marker;
                    var infowincontent = document.createElement('div');
                    
                    var restaurantName = document.createElement('h6');
                    
                    // Capacity
                    var capacity = document.createElement('h6');
                    if (busyness[i] != null) {
                        capacityText = ""
                        
                        if (busynessType[i] === 'L') {
                            capacityText += "LIVE: Currently "    
                        } else {
                            capacityText += "Historically "
                        }
                        
                        if (busyness[i]<= 25) {
                            capacity.style.color = "#02ab3a"
                            capacityText += "not busy "
                        } else if (busyness[i] <= 50) {
                            capacity.style.color = "#e5e364"
                            capacityText += "slightly busy "
                        } else if (busyness[i] <= 75) {
                            capacity.style.color = "#ff9900"
                            capacityText += "moderately busy "
                        } else {
                            capacity.style.color = "#fd7567"
                            capacityText += "very busy "
                        }
                        
                        capacityNumber = "(" + busyness[i] + "%)"
                        capacityText += capacityNumber
                        
                        capacity.textContent = capacityText
                        
                    } else {
                        capacity.textContent = "Capacity not available" 
                        capacity.style.color = "#bfbfbf"
                    }
                    
                    restaurantName.textContent = names[i] + "";
                    infowincontent.appendChild(restaurantName);
                    infowincontent.appendChild(capacity)
                    
                    var restaurantInfo = document.createElement('p');
                    
                    // Options
                    var restaurantOptions = document.createElement('div')
                    restaurantOptions.setAttribute('id', 'restaurantoptions')
 
                    if (gfoption[i] === 'Y') {
                        restaurantOptions.innerHTML += '<img src="images/gluten-free.svg" alt="Gluten-free options"/>';
                    }     
                            
                    if (vegoption[i] === 'Y') {
                        restaurantOptions.innerHTML += '<img src="images/leaf.svg" alt="Vegetarian/vegan options"/>'
                    } 
                            
                    if (deliveryoption[i] === 'Y') {
                        restaurantOptions.innerHTML += '<img src="images/meal.svg" alt="Delivery available"/>';
                    }
                            
                    if (pickupoption[i] === 'Y') {
                        restaurantOptions.innerHTML += '<img src="images/letter-p.svg" alt="Safe pick-up"/>';
                    }
                        
                    // Address
                    restaurantInfo.appendChild(restaurantOptions)
                    restaurantInfo.innerHTML += addresses[i] + "<br>";
                    // Website
                    if (websites[i] != null) {
                        link = " http://" + websites[i];
                        restaurantInfo.innerHTML += '<a href ="' + link + '">' + websites[i]+'</a><br>'
                    }
                    // Phone
                    if (phonenumbers[i] != null) {
                        restaurantInfo.innerHTML += phonenumbers[i] + "<br>"
                    }
                    // Hours
                    restaurantInfo.innerHTML += "<strong>Hours:</strong><br>"
                    
                    if (hours[i] != null) {
                        restaurantInfo.innerHTML += hours[i] + "";
                    }  else {
                        restaurantInfo.innerHTML += "Check their website for more info";
                    }

                    infowincontent.appendChild(restaurantInfo);
                    if (longitudes === null || longitudes[i] === null) {
                        if (!isNaN(addresses[i].charAt(0))) {
                            let link = addresses[i] + ", Delta, BC"
                            geocoder.geocode( {'address': link}, function(results, status) {
                                if (status == 'OK') {
                                    
                                    iconNumber = getIconColour(busyness[i])
                                
                                    marker = new google.maps.Marker({
                                        map: map,
                                        position: results[0].geometry.location,
                                        icon: icons["blue"].icon
                                    });
                                    
                                    var restID = ids[i];
                                    var latitude = parseFloat(results[0].geometry.location.lat())
                                    var longitude = parseFloat(results[0].geometry.location.lng())
                                    
                                    var input_data = {
                                        RestaurantID : restID,
                                        Lat: latitude,
                                        Lng: longitude
                                    }; 
                                    
                                    $.ajax({
                                        url:"https://vanbctogo.ca/mapdata.php",
                                        type:"POST",
                                        contentType: 'application/json; charset=utf-8',
                                        dataType: 'text',
                                        data: JSON.stringify(input_data),
                                        error: function(err) {
                                            alert(JSON.stringify(err));
                                        }
                                    })
                
                                    markers.push(marker);
                                                  
                                    marker.addListener('click', function() {
                                        infowindow.setContent(infowincontent);
                                        infowindow.open(map, marker); 
                                    });
                                    
                                    resolve();
                                } else if (status == "OVER_QUERY_LIMIT") {
                                    delayFactor++;
                                    setTimeout(function() {
                                        getGeocode(geocoder, i, infowindow);
                                    }, delayFactor * 1000);
                                } else {
                                    alert('Geocode was not successful for the following reason: ' + status);
                                }
                            })
                        } else {
                            markers.push(null)
                            resolve();
                        } 
                    } else {
                        var point = new google.maps.LatLng(
                            parseFloat(latitudes[i]),
                            parseFloat(longitudes[i])
                            );
                        
                        marker = new google.maps.Marker({
                            map: map,
                            position: point,
                            icon: icons["blue"].icon
                        })
                        markers.push(marker);
                        
                        marker.addListener('click', function() {
                            infowindow.setContent(infowincontent);
                            infowindow.open(map, marker); 
                        });
                        resolve();
                    }
                    
                });
            }
            
            function myclick(i) {
                google.maps.event.trigger(markers[i], 'click');
                map.setCenter(new google.maps.LatLng(parseFloat(latitudes[i]), parseFloat(longitudes[i])))
            }
            
            function addSideBar(i) {
                return new Promise(function(resolve) {
                    
                    if (addresses[i].charCodeAt(0) === 8203 || addresses[i].charCodeAt(0) === 35)
                        hasPhysicalAddress = !isNaN(addresses[i].charAt(1))
                    else 
                        hasPhysicalAddress = !isNaN(addresses[i].charAt(0))

                    if (i % 2 == 0) {
                        side_bar_link += '<div style="background-color:#ececec" id="restaurant">';
                    } else {
                        side_bar_link += '<div id="restaurant">';
                    }
                                            
                    side_bar_link += '<p style="font-weight: bold; padding-top: 5px;">' + names[i] + '</p>';
                                     
                    if (hasPhysicalAddress) {
                        side_bar_link += '<p style="margin-bottom: 0;">' + addresses[i] + '<br>' + postalcodes[i] + '</p>'
                        side_bar_link += '<p></p>'
                        side_bar_link += '<a class="panellink" href="javascript:myclick(' + (markers.length-1) + ')"/>View on Map</a>'
                    } else {
                        side_bar_link += '<p style="margin-bottom: 0;">' + addresses[i] + '</p>'
                    }
                    
                    side_bar_link += '<p></p></div>'
                    
                    resolve();
                })
            }
            
            function getIconColour(busynessNumber) {
                if (busynessNumber === null && busynessNumber != 0) {
                    return "gray";
                } 
                
                if (busynessNumber <= 25) {
                    return "green";
                } else if (busynessNumber <= 50) {
                    return "yellow";
                } else if (busynessNumber <= 75) {
                    return "orange";
                } else {
                    return "red";
                } 
            }
            
            
        </script>
        <script async defer
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANP1ANl5QaD-aDVVnboPbcDJ9s6YqJMzQ&callback=initMap">
        </script>
        <script src="script.js"></script>
		<footer class="footer">
			<div class="container">
				<span class="text-muted">&copy; Copyright 2020 vanbctogo.ca.</span>
			</div>
	    </footer>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>