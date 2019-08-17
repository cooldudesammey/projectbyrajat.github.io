<?php require_once("include/dbcon.php"); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>
<?php confirm_login(); ?>
<?php
if(isset($_POST['submit'])) {
	
	$Name = mysqli_real_escape_string($con, $_POST['name']);
	$Email = mysqli_real_escape_string($con, $_POST['email']);
	$Comment = mysqli_real_escape_string($con, $_POST['comment']);
	
	
	date_default_timezone_set("Asia/Kolkata");
	$date_time = strftime("%B-%d-%Y %H:%M:%S");
	$date_time;
	$getid=$_GET['id'];
		if(empty($Name) | empty($Email) | empty($Comment)){
		$_SESSION['ErorMessage']="All fields are required.";
		
	}elseif (strlen($Comment)>500) {
		$_SESSION['ErorMessage']="Not more than 500 characters are aloowed.";
		
		
	}else{
		$query = "INSERT INTO comments(datetime, name, email, comment, approvedby, status, admin_panel_id) VALUES ('$date_time','$Name','$Email','$Comment','pending', 'OFF','$getid')";
		$run= mysqli_query($con, $query);
		if ($run) {
			
		$_SESSION['successmessage']="Comment added successfully..";
		Redirect_to("fullpost.php?id={$getid}");
		}else{
		$_SESSION['ErorMessage']="Comment failed to add..";
		Redirect_to("fullpost.php?id={$getid} ");
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
	<body><!-- s -->
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
		
		<div class="container">
			<div class="blog-header">
				<h1>The Complete responsive CMS Blog</h1>
				<p class="lead">The complete project is created by Rajat Kumar Singh.</p>
			</div>
			<div class="row">
				<div class="col-sm-8 ">
					
					<div><?php echo message(); echo successmessage();?></div>
					
					<?php
					if (isset($_GET['searchbtn']))
						{
							$Search = $_GET['search'];
												$query = "SELECT * FROM admin_panel WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%'";
						}else
					{
						$Posturl = $_GET['id'];
						
						$query = "SELECT * FROM admin_panel WHERE id = '$Posturl' ORDER BY datetime desc";
					}
						$run = mysqli_query($con, $query);
						while ($DataRows=mysqli_fetch_array($run)) {
							$Postid = $DataRows['id'];
							$Datetime = $DataRows['datetime'];
							$Title = $DataRows['title'];
							$Category = $DataRows['category'];
							$Admin = $DataRows['author'];
								$Image = $DataRows['image'];
									$Post = $DataRows['post'];
												
					?>
					
					<div class="thumbnail blogpost container">
						<img height="360px" width="680px" class="mx-auto d-block mb-3 rounded" src="upload/<?php echo $Image; ?>">
						
						<div class="figure-caption">
							<h4 id="heading" class=""><?php echo htmlentities($Title);	 ?></h4>
							<p class="description">Category: <?php echo htmlentities($Category); ?> | Published on <?php echo htmlentities($Datetime); ?></p>
							<p><?php
											if (strlen($Post)>150) {
												// $Post = substr($Post,0,150).'....';
											}
							echo nl2br($Post);?></p>
						</div>
					</div>
					<?php } ?>
					<div class="mb-3 font-weight-bold span">
						<span>Comment</span><br><hr>
						<div class="font-weight-normal">
							<?php
							$fetch = $_GET['id'];
							$sql = "SELECT * FROM comments WHERE admin_panel_id='$fetch' AND status='ON'";
							$result = mysqli_query($con, $sql);
							while($datarows=mysqli_fetch_array($result))
							{
								$commentdate = $datarows['datetime'];
								$commentername =$datarows['name'];
								$comments = $datarows['comment'];
							
							?>
							<div class="main-comment">
								<img class="mt-2" src="image/comment.jpg" alt="" width="160px" height="160px;">
								<div class="sub">
									<p class="font-weight-bold"><?php echo $commentername; ?></p>
									<p class="figure-caption"><?php echo $commentdate; ?></p>
									<p><?php echo nl2br($comments); ?></p>
								</div>
							</div><br><hr>
							<?php } ?>
						</div>
						<span>Share your thought about this post</span><br>
						<span>Comment below-</span>
					</div>
					<div class="fullpost">
						<form action="" method="post" >
							<fieldset>
								<div class="form-group">
									<label for="Name"><span class="font-weight-bold">Name:</span> </label>
									<input type="text" name="name" placeholder="Name" class="form-control">
								</div>
								<div class="form-group">
									<label for="title"><span class="font-weight-bold">Email:</span> </label>
									<input type="email" name="email" placeholder="Email" class="form-control">
								</div>
								
								<div cslass="form-group">
									<label for="postarea"><span class="font-weight-bold">Comment:</span></label>
									<textarea name="comment" id="postarea"class="form-control"></textarea>
								</div>
								<br>
								<input type="submit" name="submit" value="Add your comment" class="btn btn-info btn-block mb-3">
							</fieldset>
						</form>
					</div>
				</div>
				<div class="offset-sm-1 col-sm-3 "><!-- side srea starts from here -->
				<h2 class="text-center">About me</h2><hr>
				<img class="rounded-circle border border-secondary ml-3" height="230px;" width="230px;" src="image/rajat.jpg" alt="">
				<p class="ml-3 mt-3 text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur culpa maiores, reprehenderit iste, tempora amet hic expedita error id corrupti voluptatem quis dignissimos vitae corporis esse, minima quibusdam perferendis labore!
				</p><hr>
				<div class="card border border-primary">
					<div class="card-heading bg-primary">
						<h5 class="card-title text-light text-left ml-sm-1 mt-sm-1">Categories</h5>
					</div>
					<div class="card-body">
						<?php
							$viewquery = "SELECT * FROM category";
							$run=mysqli_query($con, $viewquery);
							while ($datarows=mysqli_fetch_array($run)) {
								$id = $datarows['id'];
								$categ = $datarows['name'];
						?>
						<a href="blog.php?Category=<?php echo $categ; ?>">
							<span class="font-weight-bold text-info heading"><?php echo $categ.'<br>'; ?></span>
						</a>
						<?php } ?>
					</div>
					<div class="card-footer">
						
					</div>
					</div><!-- side category bar -->
					<div class="card border border-primary mt-4">
						<div class="card-heading bg-primary">
							<h5 class="card-title text-light text-left ml-sm-1 mt-sm-1">Recent Posts</h5>
						</div>
						<div class="card-body">
							<?php
								$recent = "SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0,5";
								$gettherecent = mysqli_query($con, $recent);
								while ($datarows=mysqli_fetch_array($gettherecent)) {
									$id = $datarows['id'];
									$title = $datarows['title'];
									$datetime = $datarows['datetime'];
									$image = $datarows['image'];
									if (strlen($datetime)>11) {
										$datetime= substr($datetime,0,14);
									}
									}
								
							?>
							<div>
								<img class="float-left" src="upload/<?php echo htmlentities($image); ?>" width="70px;" height="70px;" alt="">
								<a href="fullpost.php?id=<?php echo $id ?>">
									<p style="margin-left: 90px; " class="heading" id="heading"><?php echo htmlentities($title); ?></p>
								</a>
								<p style="margin-left:90px;"><?php  echo htmlentities($datetime); ?></p>
							</div>
						</div>
						<div class="card-footer">
						</div>
					</div>
					</div><!-- side bar ending -->
					</div><!-- row ending -->
					</div><!-- container ends here -->
					
					<div id="footer"><!-- footer div -->
					
					<h6>Created By | Rajat Kumar Singh | &copy2019 All right reserved.</h6>
					<hr style="background-color: white;">
					<p>I have created this site just to practice my coding skills. I have created this site just to practice my coding skills. I have created this site just to practice my coding skills. I have created this site just to practice my coding skills -- Rajat &trade;</p>
				</div>
			</body>
		</html>