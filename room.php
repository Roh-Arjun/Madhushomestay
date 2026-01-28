<?php
    session_start();
    include_once("includes/dbcon.php");
    $id = $_GET['id'];

    $query = "SELECT * FROM websiteDetails LIMIT 1";
    $result = mysqli_query($con, $query);
    if (!$result) {
        die("Query Failed: " . mysqli_error($con));
    }
    $website = mysqli_fetch_assoc($result);

    // Call stored procedure
    $stmt = $con->prepare("CALL getRoomID(?)");
    $stmt->bind_param("i", $id );
    $stmt->execute();

    // First result set: Product details
    $result1 = $stmt->get_result();
    if ($result1) {
        $room = $result1->fetch_all(MYSQLI_ASSOC);
        $finalRoom=$room[0];
       // $imagesArray2 = explode(";", $finalproduct['imageURL']);
    }

    $stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?=$website['name']?> - Rooms</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
      /* Ensure the image is responsive while maintaining its aspect ratio */
.map-container {
  max-width: 100%; /* Ensures it adapts to different screen sizes */
  display: block;
  overflow: hidden;
  text-align: center;
}

.map-container img {
  width: 100%;
  height: auto; /* Maintains the aspect ratio */
  max-width: 541px; /* Optional: Keeps the original dimension as the max size */
  max-height: 273px; /* Optional: Keeps the original height limit */
}
    </style>
    
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="icon" type="image/x-icon" sizes="32x32" href="assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon/favicon-16x16.png">
    <link rel="icon" type="image/png" href="assets/images/favicon/favicon.ico">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">

    <link rel="stylesheet" href="assets/css/aos.css">

    <link rel="stylesheet" href="assets/css/ionicons.min.css">

    <link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="assets/css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/icomoon.css">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-dark" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index">Madhu's <span>HomeStay</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item"><a href="index" class="nav-link">Home</a></li>
	          <!-- <li class="nav-item active"><a href="rooms.html" class="nav-link">Our Rooms</a></li> -->
	          <!-- <li class="nav-item"><a href="restaurant.html" class="nav-link">Restaurant</a></li> -->
	          <!-- <li class="nav-item"><a href="about.html" class="nav-link">About Us</a></li> -->
	          <!-- <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li> -->
	          <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->

    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
          	<div class="row">
          		<div class="col-md-12 ftco-animate">
          			<div class="single-slider owl-carousel">
          				<div class="item">
          					<div class="room-img" id="img1" style="background-image: url(<?=$finalRoom['img1']?>);"></div>
          				</div>
          				<div class="item">
          					<div class="room-img" id="img2" style="background-image: url(<?=$finalRoom['img2']?>);"></div>
          				</div>
          				<div class="item">
          					<div class="room-img" id="img3" style="background-image: url(<?=$finalRoom['img3']?>);"></div>
          				</div>
          			</div>
          		</div>
          		<div class="col-md-12 room-single mt-4 mb-5 ftco-animate">
                <h5 class="text-primary mb-2">₹ <?=$finalRoom['price']?> <?php echo $label = ($finalRoom['type'] === 'Family' || $finalRoom['type']=== 'Group') ? 'per Night/Head' : 'per Night';?></h5>
          			<h2 class="mb-4" id="roomname"></h2>
    						<!-- <p>When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way.</p> -->
    						<div class="container">
                  <!-- <a href="bookconfirm.html" class="btn btn-primary">Book Room</a> -->
                  <!-- <a href="#" class="btn btn-primary"> <i class="icon icon-bed"  ></i> Book</a>  -->
                  <a href="#" onclick="whatsappmessage()" class="btn btn-primary"> <i class="icon icon-whatsapp"  ></i> Whatsapp</a> 
                  <a href="tel:+91<?= $website['secondaryphno']?>" class="btn btn-primary"> <i class="icon icon-phone"></i> </a>
                  <a href="tel:+91<?= $website['secondaryphno']?>" class="btn btn-primary"> <i class="icon icon-phone"></i> </a>
                  <a href="#" onclick="sharefunc(event)" class="btn btn-primary"> <i class="icon icon-share"></i> Share</a>
                </div><br>
                <div><ul>
                  <li><a href="tel:+91<?= $website['primaryphno']?>"><span class="icon icon-phone"></span><span class="text"> +91 <?= $website['primaryphno']?></span></a></li>
                  <li><a href="tel:+91<?= $website['secondaryphno']?>"><span class="icon icon-phone"></span><span class="text"> +91 <?= $website['secondaryphno']?></span></a></li>
                </ul></div>
                <h3>Benfits of Home Stay</h3>
                <div class="d-md-flex mt-3 mb-3">
    							<ul class="list">
	    							<li><span>Food: </span><a id="food"><?=$finalRoom['food']?></a></li>
	    							<li><span>Fire Camp: </span><a id="firecamp"><?=$finalRoom['firecamp']?></a></li>
                    <li><span>Music: </span><a id="music"><?=$finalRoom['music']?></a > </li>
                    <li><span>Games: </span><a id="games"><?=$finalRoom['games']?></a> </li>
	    						</ul>
	    						<ul class="list ml-md-5">
	    							<li><span>Parking:</span> Available</li>
                    <li><span>Hot Water:</span> 24/7</li>
                    <li><span>Pickup/Drop:</span> Available/Charged</li>

	    							<!-- <li><span>:</span> 1</li> -->
	    						</ul>
    						</div>
                <h4>Activites</h4>
                <div class="d-md-flex mt-3 mb-3">
    							<ul class="list">
	    							<li><span>✔ Carrom</span></li>
	    							<li><span>✔ Chess</span></li>
                    <li><span>✔ Ball Badminton</span></li>
                    <li><span>✔ Shuttle Bat</span></li>
	    						</ul>
	    						<ul class="list ml-md-5">
	    							<li><span>✔ Skipping</span></li>
                    <li><span>✔ Volley Ball</span></li>
                    <li><span>✔ Throw Ball</span></li>
                    <li><span>✔ Ludo</span></li>
	    						</ul>
    						</div>
                <div class="map-container">
                  <a target="_blank" href="<?= $website['gMap']?>" target="_blank"><img src="assets/images/Mapimg.png"></a>
                </div><br>
                <p style="font-weight: bolder;">Note: If you booked HomeStay, then it apply from 12:00 PM to Next day 12:00 PM </p>
    						<p>Escape to the serene beauty of Coorg and experience the ultimate homestay retreat surrounded by lush greenery and the sounds of nature. At our homestay, 
                  we offer an unforgettable experience with unlimited delicious vegetarian and non-vegetarian meals prepared with fresh local ingredients. Enjoy cozy evenings by the campfire, 
                  indulge in music and games, and embrace the outdoors with fun activities like volleyball, throwball, badminton, carrom, chess, and more. Whether you're looking to relax or stay active, our homestay is the perfect getaway for families, friends, and nature lovers. Come, unwind, and create memories that will last a lifetime!</p>
          		</div>
            
              <div class="container">
                <!-- <a href="bookconfirm.html" class="btn btn-primary">Book Room</a> -->
                <!-- <a href="#" class="btn btn-primary"> <i class="icon icon-bed"  ></i> Book</a>  -->
                <a href="#"  onclick="whatsappmessage()" class="btn btn-primary"> <i class="icon icon-whatsapp"  ></i> Whatsapp</a> 
                <a href="tel:+91<?=$website['primaryphno']?>" class="btn btn-primary"> <i class="icon icon-phone"></i> </a>
                <a href="tel:+91<?=$website['secondaryphno']?>" class="btn btn-primary"> <i class="icon icon-phone"></i> </a>
                <a href="#" onclick="sharefunc(event)" class="btn btn-primary"> <i class="icon icon-share"></i> Share</a>
              </div>
          	</div>
          </div> 
        </div>
      </div>
    </section> <!-- .section -->


    <footer class="ftco-footer ftco-section img" >
    	<div class="overlay"></div>
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2"><?= $website['name']?></h2>
              <p>Make your travel unforgettable by staying at our HomeStay.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <!-- <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li> -->
                <!-- <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li> -->
                <li class="ftco-animate"><a href="<?= $website['insta']?>"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <!-- <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">Useful Links</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Blog</a></li>
                <li><a href="#" class="py-2 d-block">Rooms</a></li>
                <li><a href="#" class="py-2 d-block">Amenities</a></li>
                <li><a href="#" class="py-2 d-block">Gift Card</a></li>
              </ul>
            </div>
          </div> -->
          <!-- <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Privacy</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Career</a></li>
                <li><a href="#" class="py-2 d-block">About Us</a></li>
                <li><a href="#" class="py-2 d-block">Contact Us</a></li>
                <li><a href="#" class="py-2 d-block">Services</a></li>
              </ul>
            </div>
          </div> -->
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><a href="<?= $website['gMap']?>" target="_blank"><span class="icon icon-map-marker"></span><span class="text"><?= $website['address']?></span></a></li>
	                <li><a href="tel:+91<?= $website['primaryphno']?>"><span class="icon icon-phone"></span><span class="text">+91 <?= $website['primaryphno']?></span></a></li>
                  <li><a href="tel:+91<?= $website['secondaryphno']?>"><span class="icon icon-phone"></span><span class="text">+91 <?= $website['secondaryphno']?></span></a></li>
                  <li><a href="mailto:<?= $website['email']?>"><span class="icon icon-envelope"></span><span class="text"><?= $website['email']?></span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery.easing.1.3.js"></script>
  <script src="assets/js/jquery.waypoints.min.js"></script>
  <script src="assets/js/jquery.stellar.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  <script src="assets/js/jquery.magnific-popup.min.js"></script>
  <script src="assets/js/aos.js"></script>
  <script src="assets/js/jquery.animateNumber.min.js"></script>
  <script src="assets/js/bootstrap-datepicker.js"></script>
  <script src="assets/js/scrollax.min.js"></script>
  <script src="assets/js/main.js"></script>

  <script src="assets/services/roomservice.js"></script>
    
  </body>
</html>