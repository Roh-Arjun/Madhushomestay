<?php 
	session_start();
    include_once("../includes/dbcon.php");
    $query = "SELECT * FROM websiteDetails LIMIT 1";
    $result = mysqli_query($con, $query);
    if (!$result) {
        die("Query Failed: " . mysqli_error($con));
    }
    $website = mysqli_fetch_assoc($result);
	$authorisation = isset($_SESSION['adminData']['admin_id']);
    if (!$authorisation) {
        header("Location: login");
        exit;
    }

	if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullname  = trim($_POST["name"]);
    $email = trim($_POST["email"]);
	$role= trim($_POST['role']);
    $phone =trim($_POST['phone']);
	$address =trim($_POST['address']);
    $pass  = $_POST["password"];
	$confirmpass = $_POST["confirmpassword"];
	$isAllowed=1;
	$isAdmin= $role === 'SA' ? 1 : 0;
    $createddate=date('Y-m-d H:i:s');

    if (empty($fullname) || empty($email) || empty($role) || empty($phone) || empty($pass) || empty($confirmpass)) {
			unset($_SESSION["success"]);
        $error = "All fields are required.";
    } else if($pass!== $confirmpass){
		unset($_SESSION["success"]);
		$error = "Password doesn't matches.";
	} else {
        // Check if email already exists
        $stmt = $con->prepare("SELECT id FROM admin WHERE email = ?");
        $stmt->bind_param("s", $email); // "s" = string
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Email is already registered!";
			unset($_SESSION["success"]);
        } else {
            $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

            $stmt = $con->prepare("INSERT INTO admin (fullName, email, phone, address, password, role, isAllowed, createdAt, isAdmin) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssisi", $fullname, $email, $phone, $address, $hashedPassword, $role, $isAllowed, $createddate, $isAdmin); 
            $stmt->execute();
			$error="";
			$_SESSION["success"] = "Registration successful!";
           	header("Location: signup");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <title><?= $website['name']?> Portal - Sign up</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Tripada fashions">
    <meta name="author" content="rohit">    
    <link rel="shortcut icon" href="favicon.ico"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

</head> 

<body class="app app-signup p-0">    
		
    <div class="row g-0 app-auth-wrapper">
		<div>
		<a href="index" class="btn btn-primary">back</a>
	</div>
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
			
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">	
					
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="index"><img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-4">Sign up to Portal</h2>	
					<?php if(!empty($error)){ ?>				
					<div><p class="text-danger"><?=$error?></p></div>
					<?php }?>
					<?php if(isset($_SESSION["success"])){ 
						?>
					<div><p class="text-success"><?=$_SESSION["success"]?></p></div>
					<?php  }?>
					<div class="auth-form-container text-start mx-auto">
						<form method="POST" class="auth-form auth-signup-form">         
							<div class="email mb-3">
								<label class="sr-only" for="signup-email">Your Name</label>
								<input id="signup-name" name="name" type="text" class="form-control signup-name" placeholder="Full name" required>
							</div>
							<div class="email mb-3">
								<label class="sr-only" for="signup-email">Your Email</label>
								<input id="signup-email" name="email" type="email" class="form-control signup-email" placeholder="Email" required>
							</div>
							<div class="email mb-3">
								<label class="sr-only" for="signup-role">Role</label>
								<!-- <input id="signup-role" name="role" type="text" class="form-control signup-name" placeholder="Role" required> -->
								 <select name="role" class="form-control signup-name" id="signup-role" required>
                                            <option disabled selected value=""> --- Please Select Role --- </option>
                                            <option value="SA">Super Admin</option>
											<option value="Manager">Manager</option>
                                </select>
							</div>
							<div class="email mb-3">
								<label class="sr-only" for="signup-phone">Phone Number</label>
								<input id="signup-phone" name="phone" type="text" class="form-control signup-phone" placeholder="Phone Number" required>
							</div>
							<div class="email mb-3">
								<label class="sr-only" for="signup-address">Address</label>
								<input id="signup-address" name="address" type="text" class="form-control signup-address" placeholder="Address" required>
							</div>
							<div class="password mb-3">
								<label class="sr-only" for="signup-password">Password</label>
								<input id="signup-password" name="password" type="password" class="form-control signup-password" placeholder="Create a password" required>
							</div>
							<div class="password mb-3">
								<label class="sr-only" for="confirm-password">Confirm Password</label>
								<input id="confirm-password" name="confirmpassword" type="password" class="form-control signup-password" placeholder="Confirm password" required>
							</div>
							<!-- <div class="extra mb-3">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="" id="RememberPassword">
									<label class="form-check-label" for="RememberPassword">
									I agree to Portal's <a href="#" class="app-link">Terms of Service</a> and <a href="#" class="app-link">Privacy Policy</a>.
									</label>
								</div>
							</div> -->
							<!--//extra-->
							
							<div class="text-center">
								<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Sign Up</button>
							</div>
						</form><!--//auth-form-->
						
						<!-- <div class="auth-option text-center pt-5">Already have an account? <a class="text-link" href="login.html" >Log in</a></div> -->
					</div><!--//auth-form-container-->	
					
					
				    
			    </div><!--//auth-body-->
		    

		    </div><!--//flex-column-->   
	    </div><!--//auth-main-col-->
	    <div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
		    <div class="auth-background-holder">			    
		    </div>
		    <div class="auth-background-mask"></div>
		    <div class="auth-background-overlay p-3 p-lg-5">
			    <div class="d-flex flex-column align-content-end h-100">
				    <div class="h-100"></div>
				    <div class="overlay-content p-3 p-lg-4 rounded">
					    <h5 class="mb-3 overlay-title"><?=$website['name']?></h5>
					    <!-- <div>Portal is a free Bootstrap 5 admin dashboard template. You can download and view the template license </div> -->
				    </div>
				</div>
		    </div><!--//auth-background-overlay-->
	    </div><!--//auth-background-col-->
    
    </div><!--//row-->


</body>
</html> 

