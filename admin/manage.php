<?php 
	session_start();
    include_once("../includes/dbcon.php");
    $query = "SELECT * FROM websiteDetails LIMIT 1";
    $result = mysqli_query($con, $query);
    if (!$result) {
        die("Query Failed: " . mysqli_error($con));
    }
    $website = mysqli_fetch_assoc($result);
	$authorisation = isset($_SESSION['MadhusData']['Madhus_id']);
    if (!$authorisation) {
        header("Location: login");
        exit;
    }

	$type=null;
	$getorderstmt = $con->prepare("CALL getRooms(?)");
    $getorderstmt->bind_param("s", $type);
    $getorderstmt->execute();
    $getorderresult = $getorderstmt->get_result();
    $getorderstmt->close();

	if ($_SERVER["REQUEST_METHOD"] === "POST") {
		$fullName=trim($_POST["searchName"]);
		print_r($fullName);
		$getorderstmt = $con->prepare("CALL getRooms(?)");
		$getorderstmt->bind_param("s", $type);
		$getorderstmt->execute();
		$getorderresult = $getorderstmt->get_result();
		$getorderstmt->close();
	}

?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <title><?=$website['name']?> - Manage</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Manage Rooms">   
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">
</head> 

<body class="app"> 
    <header class="app-header fixed-top">	   	            
        <div class="app-header-inner">  
	        <div class="container-fluid py-2">
		        <div class="app-header-content"> 
		            <div class="row justify-content-between align-items-center">
			        
				    <div class="col-auto">
					    <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
						    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img"><title>Menu</title><path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path></svg>
					    </a>
				    </div><!--//col-->
		            <div class="search-mobile-trigger d-sm-none col">
			            <i class="search-mobile-trigger-icon fa-solid fa-magnifying-glass"></i>
			        </div><!--//col-->
		            
		            <div class="app-utilities col-auto">
			            
			            <div class="app-utility-item app-user-dropdown dropdown">
				            <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><img src="assets/images/user.jpg" alt="user profile"></a>
				            <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
								<li><a class="dropdown-item" href="account">Account</a></li>
								<li><hr class="dropdown-divider"></li>
								<li><a class="dropdown-item" href="logout">Log Out</a></li>
							</ul>
			            </div><!--//app-user-dropdown--> 
		            </div><!--//app-utilities-->
		        </div><!--//row-->
	            </div><!--//app-header-content-->
	        </div><!--//container-fluid-->
        </div><!--//app-header-inner-->
        <div id="app-sidepanel" class="app-sidepanel sidepanel-hidden"> 
	        <div id="sidepanel-drop" class="sidepanel-drop"></div>
	        <div class="sidepanel-inner d-flex flex-column">
		        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
		        <div class="app-branding">
		            <a class="app-logo" href="index"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"><span class="logo-text">PORTAL</span></a>
	
		        </div><!--//app-branding-->  
			    <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
				    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
					    <li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link" href="index">
						        <span class="nav-icon">
						        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-door" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
		  <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z"/>
		  <path fill-rule="evenodd" d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
		</svg>
						         </span>
		                         <span class="nav-link-text">Overview</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->
					    <li class="nav-item">
					        <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
					        <a class="nav-link active" href="manage">
						        <span class="nav-icon">
						        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-folder" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path d="M9.828 4a3 3 0 0 1-2.12-.879l-.83-.828A1 1 0 0 0 6.173 2H2.5a1 1 0 0 0-1 .981L1.546 4h-1L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3v1z"/>
  <path fill-rule="evenodd" d="M13.81 4H2.19a1 1 0 0 0-.996 1.09l.637 7a1 1 0 0 0 .995.91h10.348a1 1 0 0 0 .995-.91l.637-7A1 1 0 0 0 13.81 4zM2.19 3A2 2 0 0 0 .198 5.181l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H2.19z"/>
</svg>
						         </span>
		                         <span class="nav-link-text">Manage</span>
					        </a><!--//nav-link-->
					    </li><!--//nav-item-->
					    
				    </ul><!--//app-menu-->
			    </nav><!--//app-nav-->
	        </div><!--//sidepanel-inner-->
	    </div><!--//app-sidepanel-->
    </header><!--//app-header-->
    
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Manage</h1>
				    </div>
				    <div class="col-auto">
					     <div class="page-utilities">
						    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
							    <div class="col-auto">
								    
								    <!-- <select class="form-select w-auto" >
										  <option selected value="option-1">All</option>
										  <option value="option-2">Couple</option>
										  <option value="option-3">Family</option>
										  <option value="option-4">Group</option>
										  <option value="option-5">Single</option>
										  
									</select> -->
							    </div>
						    </div><!--//row-->
					    </div><!--//table-utilities-->
				    </div><!--//col-auto-->
			    </div><!--//row-->
			   
			    
			    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
				    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All</a>
				    <!-- <a class="flex-sm-fill text-sm-center nav-link"  id="orders-submitted-tab" data-bs-toggle="tab" href="#orders-submitted" role="tab" aria-controls="orders-submitted" aria-selected="false">Submitted</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-dispatched-tab" data-bs-toggle="tab" href="#orders-dispatched" role="tab" aria-controls="orders-dispatched" aria-selected="false">Dispatched</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-delivered-tab" data-bs-toggle="tab" href="#orders-delivered" role="tab" aria-controls="orders-delivered" aria-selected="false">Delivered</a>
					<a class="flex-sm-fill text-sm-center nav-link" id="orders-failed-tab" data-bs-toggle="tab" href="#orders-failed" role="tab" aria-controls="orders-failed" aria-selected="false">Failed</a> -->
				</nav>
				
				
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <!-- -->

								<div class="table-responsive">
    <table class="table app-table-hover mb-0 text-left">
        <thead>
            <tr>
                <th class="cell">ID</th>
                <th class="cell">Type</th>
                <th class="cell">Name</th>
                <th class="cell">Price</th>
                <!-- <th class="cell">Phone</th>
                <th class="cell">Subscribe</th> -->
                <th class="cell"></th>
            </tr>
        </thead>
        <tbody>
            <?php if($getorderresult->num_rows > 0){
                while($row = $getorderresult->fetch_assoc()) {
                    $orderId = $row['id'];
            ?>
            <tr>
                <td class="cell">#<?=$orderId?></td>
                <td class="cell"><span class="truncate"><?=$row['type']?></span></td>
                <td class="cell"><?=$row['display']?></td>
                <td class="cell"><?=$row['price']?></td>
                <td class="cell">
                    <a class="btn-sm app-btn-secondary" data-bs-toggle="collapse" href="#details<?=$orderId?>" role="button" aria-expanded="false" aria-controls="details<?=$orderId?>">
                        View
                    </a>
                </td>
            </tr>
            <tr class="collapse-row">
                <td colspan="3" class="p-0 border-0">
                    <div class="collapse" id="details<?=$orderId?>">
                        <div class="card card-body bg-light">
                            <strong>Food:</strong> <?=$row['food']?><br>
                            <strong>Fire Camp:</strong> <?=$row['firecamp']?><br>
                            <strong>Music:</strong> <?=$row['music']?> <br>
                            <strong>Games:</strong> <?=$row['games']?><br>
                        </div>
                    </div>
                </td>
				<td colspan="3" class="p-0 border-0">
                    <div class="collapse" id="details<?=$orderId?>">
                        <div class="card card-body bg-light">
							<strong>Update Price:</strong> <form class="settings-form" onsubmit="UpdatePrice(event)">
							<input class="form-control" name="updatePrice" type="number" required><br>
							<input type="hidden" name="roomId" value="<?=$row['id']?>">
							<input type="submit" class="btn btn-primary" value="Subscribe"> </form>
                        </div>
                    </div>
                </td>
            </tr>
            <?php } } else { ?>
            <tr>
                <td colspan="7" class="text-center text-danger">No Records Found!</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
								<!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
						<!-- <nav class="app-pagination">
							<ul class="pagination justify-content-center">
								<li class="page-item disabled">
									<a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
							    </li>
								<li class="page-item active"><a class="page-link" href="#">1</a></li>
								<li class="page-item"><a class="page-link" href="#">2</a></li>
								<li class="page-item"><a class="page-link" href="#">3</a></li>
								<li class="page-item">
								    <a class="page-link" href="#">Next</a>
								</li>
							</ul>
						</nav> -->
						<!--//app-pagination-->
						
			        </div><!--//tab-pane-->
			        
				</div><!--//tab-content-->
				
				
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
	    
	    
    </div><!--//app-wrapper-->    					

 
    <!-- Javascript -->          
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
	
	<script>
 function UpdatePrice(e) {
    e.preventDefault();
	const form = e.target; 

    // Use FormData for AJAX upload
    const formData = new FormData(form);
	const now = new Date();
    formData.append("updatedAt", now.toISOString()); 

    fetch("services/updatePrice.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if(data === 'S001'){
            alert("Updated successfully!");
			location.reload(true);
        }else{
            alert(data);
        }
    })
    .catch(err => alert("Upload failed: " + err));
}
    </script>

	
    
    
    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script> 

</body>
</html> 

