<?php require_once("include/dbcon.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php confirm_login(); ?>
<?php
if (isset($_POST['submit'])) {
	
	$Title = mysqli_real_escape_string($con, $_POST['title']);
	$Category = mysqli_real_escape_string($con, $_POST['category']);
	$Post = mysqli_real_escape_string($con, $_POST['post']);
	$admin = "Rajat Singh";
	$image = $_FILES['image']['name'];
	$target = "upload/".basename($_FILES['image']['name']);
	date_default_timezone_set("Asia/Kolkata");
	$date_time = strftime("%B-%d-%Y %H:%M:%S");
	$date_time;
		move_uploaded_file($_FILES['image']['tmp_name'], $target);
		$deleteid = $_GET['Delete'];
		$query = "DELETE FROM admin_panel WHERE id = '$deleteid'";
		$run= mysqli_query($con, $query);
		if ($run)
	{
			
		$_SESSION['successmessage']="Post Deleted successfully..";
		Redirect_to('index.php');
		}else
	{
		$_SESSION['ErorMessage']="Post failed to delete..";
		Redirect_to('index.php');
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
			<a class="border border-primary border-left-0 border-top-0 border-bottom-0" href="blog.php" ><img src="upload/2.png" alt="" style="margin-top: -45px; margin-bottom: -45px; height: 170px; "></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
					<li class="nav-item">
						<a class="nav-link" href="index.php">Home</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="blog.php?page=1">Blog</a>
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
				<form class="form-inline my-2 my-lg-0" action="blog.php">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="searchbtn">Search</button>
				</form>
			</div>
			</nav><!-- nav bar ends here -->
			<hr class="bg-primary pt-1 mt-0">
			
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-2">
						<ul class="nav nav-pills flex-column" id="sidemenu">
							<li class="nav-item"><a href="index.php" class="nav-link"><i class="fas fa-th"></i> Dashboard</a></li>
							<li class="nav-item"><a href="addnewpost.php" class="nav-link active"><i class="fas fa-th-list"></i> Add New Post</a></li>
							<li class="nav-item"><a href="categories.php" class="nav-link "><i class="fas fa-tags"></i> Categories</a></li>
							<li class="nav-item"><a href="manageaccount.php" class="nav-link"><i class="fas fa-user"></i> Manage Admins</a></li>
							<li class="nav-item"><a href="comments.php" class="nav-link"><i class="fas fa-comment-alt"></i> Comments</a></li>
							<li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-laptop-code"></i> Live Blog</a></li>
							<li class="nav-item"><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
						</ul>
						</div> <!-- Ending of side area -->
						<div class="col-sm-10">
							<h1 align="center">Deletes Post</h1><hr class="bg-secondary">
							
							<div><?php echo message(); echo successmessage();?></div>
							<div>
								<?php
									$getid = $_GET['Delete'];
									$query = "SELECT * FROM admin_panel WHERE id ='$getid'";
									$run = mysqli_query($con, $query);
									while ($datarows=mysqli_fetch_array($run)) {
										$Titleupdate = $datarows['title'];
										$Category = $datarows['category'];
										$Imageupdate = $datarows['image'];
										$Postupdate = $datarows['post'];
									}
								?>
								<form action="deletepost.php?Delete=<?php echo $getid; ?>" method="post" enctype="multipart/form-data">
									<fieldset>
										<div class="form-group">
											<label for="title"><span class="font-weight-bold">Title:</span> </label>
											<input disabled value="<?php echo $Titleupdate; ?>" type="text" name="title" placeholder="Title" class="form-control">
										</div>
										<div class="form-group">
											<label for=""><span class="font-weight-bold">Existing Category: </span></label>
											<?php echo $Category; ?><br>
											<label for="categoryselect"><span class="font-weight-bold">Category:</span> </label>
											<select disabled="" id="categoryselect" class="form-control" name="category">
												
												<?php
												$query = "SELECT * FROM category ORDER BY datetime desc";
												$run = mysqli_query($con, $query);
												
												while ($DataRows=mysqli_fetch_array($run)) {
													$id=$DataRows['id'];
													$categoryname = $DataRows['name'];
												
												?>
												<option><?php echo $categoryname; ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<label for=""><span class="font-weight-bold">Existing Image: </span></label>
											<img  src="upload/<?php echo $Imageupdate; ?>" width="170px;" height="80px;" alt=""><br>
											<label for="imageselect"><span class="font-weight-bold">Select Image:</span></label>
											<input disabled type="file" class="form-control" name="image" id="imageselect">
										</div>
										
										<div class="form-group">
											<label for="postarea"><span class="font-weight-bold">Post:</span></label>
											<textarea disabled="" name="post" id="postarea"class="form-control"><?php echo $Postupdate; ?></textarea>
										</div>
										<br>
										<input type="submit" name="submit" value="Delete post" class="btn btn-danger btn-block mb-3">
									</fieldset>
								</form>
								</div><!-- form div ends -->
								<div>
								</div>
								</div>  <!-- Ending of main area -->
								</div> <!-- Ending of row -->
								</div> <!-- Ending of container fluid -->
								<div id="footer">
									
									<h6>Created By | Rajat Kumar Singh | &copy2019 All right reserved.</h6>
									<hr style="background-color: white;">
									<p>I have created this site just to practice my coding skills. I have created this site just to practice my coding skills. I have created this site just to practice my coding skills. I have created this site just to practice my coding skills -- Rajat &trade;</p>
								</div>
							</body>
						</html>