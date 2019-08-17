<?php require_once("include/dbcon.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php
if (isset($_POST['submit'])) {
	
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	
	if(empty($username) || empty($password) ){
		$_SESSION['ErorMessage']="*All fields are required..";
		Redirect_to('login.php');
	
	}else{
			$login = loginattempt($username, $password);
			if ($login) {
		$_SESSION['user_id']=$login['id'];
		$_SESSION['user_name']=$login['username'];
		$_SESSION['successmessage']="Welcome {$_SESSION['user_name']} !!";
		Redirect_to('index.php');
			}else{
		$_SESSION['ErorMessage']="Username or password is invalid..";
		Redirect_to('login.php');
			}
		
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title></title><!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	</head>
	<body>
		<hr class="bg-primary pt-1 mt-0 mb-0">
		<nav class="navbar navbar-expand-lg navbar-light">
			
			<a class=" border border-primary border-left-0 border-top-0 border-bottom-0" href="blog.php" ><img src="upload/2.png" alt="" style="margin-top: -45px; margin-bottom: -45px; height: 170px; "></a>
			
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="blog.php?page=1" >Blog</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#" >About us</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#" >Services</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#" >Contact us</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#" >Feature</a>
					</li>
				</ul>
				
			</div>
			</nav><!-- nav bar ends here -->
			<hr class="bg-primary pt-1 mt-0">
			<div class="container-fluid">
				<div class="row">
					
					<div class="col-sm-4 mx-auto mt-5">
						<h1 align="center">Welcome back!</h1>
						
						<div><?php echo message(); echo successmessage();?></div>
						<div class="mt-5">
							<form action="login.php" method="post">
								<fieldset>
									<div class="form-group">
										<label for="Username"><span class="font-weight-bold">Username:</span> </label>
										<div class="input-group mb3 input-group-sm ">
											<span class="input-group-text"><i class="fa fa-envelope"></i></span>
											
											<input type="text" name="username" placeholder="Type the username" class="form-control">
										</div>
									</div>
									
									<div class="form-group">
										
										<label for="password"><span class="font-weight-bold">Password:</span> </label>
										<div class="input-group mb3 input-group-sm ">
											<span class="input-group-text"><i class="fa fa-lock"></i></span>
											
											<input type="password" name="password" placeholder="Enter password" class="form-control">
										</div>
										<br>
										<input type="submit" name="submit" value="Login" class="btn btn-info btn-block mb-4">
									</fieldset>
								</form>
								</div><!-- form div ends -->
								<div>
									
								</div>
								</div>  <!-- Ending of main area -->
								</div> <!-- Ending of row -->
								</div> <!-- Ending of container fluid -->
								
							</body>
						</html>