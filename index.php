<?php require_once('include/dbcon.php'); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once('include/functions.php') ?>
<?php confirm_login(); ?>
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
					
					<li class="nav-item active">
						<a class="nav-link" href="blog.php?page=1">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="index.php">Admin</a>
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
			<div class="container-fluid ">
				<div class="row">
					<div class="col-sm-2 border border-top-0 border-info">
						
						<ul class="nav nav-pills flex-column" id="sidemenu">
							<li class="nav-item"><a href="index.php" class="nav-link active"><i class="fas fa-th"></i> Dashboard</a></li>
							<li class="nav-item"><a href="addnewpost.php" class="nav-link"><i class="fas fa-th-list"></i> Add New Post</a></li>
							<li class="nav-item"><a href="categories.php" class="nav-link "><i class="fas fa-tags"></i> Categories</a></li>
							<li class="nav-item"><a href="manageaccount.php" class="nav-link"><i class="fas fa-user"></i> Manage Admins</a></li>
							<li class="nav-item"><a href="comments.php" class="nav-link"><i class="fas fa-comment-alt"></i>Comments
								<?php
									$logic = "SELECT COUNT(*) FROM comments WHERE status='OFF' ";
									$result= mysqli_query($con, $logic);
									$notify = mysqli_fetch_array($result);
									$show = array_shift($notify);
									if(($show)>0){
								?>
								<span class="badge badge-danger ml-2"><?php echo $show; ?></span>
								<?php } ?><!-- notification of comments which are approved -->
							</a></li>
							<li class="nav-item"><a href="#" class="nav-link"><i class="fas fa-laptop-code"></i> Live Blog</a></li>
							<li class="nav-item"><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
						</ul>
						</div> <!-- Ending of side area -->
						<div class="col-sm-10">
							<h5 class="text-center font-weight-bold ">Rajat's dummy data</h5>
							<div><?php echo message(); echo successmessage();?></div>
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover">
									<tr>
										<th>No.</th>
										<th>Post Title</th>
										<th>Date & Time</th>
										<th>Author</th>
										<th>Category</th>
										<th>Banner</th>
										<th>Comments</th>
										<th>Action</th>
										<th>Details</th>
									</tr>
									<?php
									$query = "SELECT * FROM admin_panel ORDER BY datetime desc";
									$run = mysqli_query($con, $query);
									$Srno=0;
									while($datarows=mysqli_fetch_array($run))
									{
										$ID = $datarows['id'];
										$Datetime = $datarows['datetime'];
										$Title = $datarows['title'];
										$Category = $datarows['category'];
										$Admin = $datarows['author'];
										$Image = $datarows['image'];
										$Post = $datarows['post'];
										$Srno++;
									
									?>
									<tr>
										<td><?php echo $Srno; ?></td>
										<td class="font-weight-bold text-primary">
											<?php
												if(strlen($Title)>15)
													{
														$Title=substr($Title,0,14).'..';
													}
												echo $Title;
											?>
										</td>
										<td><?php
															if(strlen($Datetime)>5)
																{
																	$Datetime=substr($Datetime,0,10).'..';
																}
													echo $Datetime;
											?>
										</td>
										<td>
											<?php
												if(strlen($Admin)>6)
													{
														$Admin=substr($Admin,0,6).'..';
													}
											echo $Admin;
											?>
											
										</td>
										<td>
											<?php
												if(strlen($Category)>6)
													{
														$Category=substr($Category,0,11).'..';
													}
											echo $Category;
										?></td>
										<td><img src="upload/<?php echo $Image ?>" width="120px;" height="50px;"></td>
										<td>
											
											<?php
												$logic = "SELECT COUNT(*) FROM comments WHERE admin_panel_id = '$ID' AND status='ON' ";
												$result= mysqli_query($con, $logic);
												$notify = mysqli_fetch_array($result);
												$show = array_shift($notify);
												if(($show)>0){
											?>
											<span class="badge float-right badge-success"><?php echo $show; ?></span>
											<?php } ?> <!-- notification of comments which are not approved -->
											
											<?php
												$logic = "SELECT COUNT(*) FROM comments WHERE admin_panel_id = '$ID' AND status='OFF' ";
												$result= mysqli_query($con, $logic);
												$notify = mysqli_fetch_array($result);
												$show = array_shift($notify);
												if(($show)>0){
											?>
											<span class="badge badge-danger float-left"><?php echo $show; ?></span>
											<?php } ?><!-- notification of comments which are approved -->
										</td>
										<td>
											<a href="editpost.php?Edit=<?php echo $ID ?>"><span class="btn btn-warning">Edit</span></a>
											<a href="deletepost.php?Delete=<?php echo $ID ?>"><span class="btn btn-danger">Delete</span></a>
										</td>
										<td>
											<a href="fullpost.php?id=<?php echo $ID ?>" target="_blank"><span class="btn btn-primary">Live Preview</span></a>
										</td>
									</tr>
									<?php } ?>
								</table>
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