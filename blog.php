<?php require_once('include/dbcon.php'); ?>
<?php require_once('include/functions.php'); ?>

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
		<a class=" border border-primary border-left-0 border-top-0 border-bottom-0" href="blog.php" ><img src="upload/2.png" alt="" style="margin-top: -45px; margin-bottom: -45px; height: 170px; "></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				
				<li class="nav-item">
					<a class="nav-link active" href="blog.php?page=1" >Home</a>
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
		
		<div class="container">
			<div class="blog-header">
				<h1>The Complete responsive CMS Blog</h1>
				<p class="lead">The complete project is created by Rajat Kumar Singh.</p>
			</div>
			<div class="row">
				<div class="col-sm-8 ">
					
					<?php
					//search query when search btn is active
					if (isset($_GET['searchbtn']))
						{
							$Search = $_GET['search'];
												$query = "SELECT * FROM admin_panel WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%' OR category LIKE '%$Search%' OR post LIKE '%$Search%'";
						
						}elseif (isset($_GET['Category'])){
							//query when category is active
							$category= $_GET['Category'];
							$query= "SELECT * FROM admin_panel WHERE category = '$category' ORDER BY datetime desc"; 
						}
							//query when pagination is active
						elseif(isset($_GET['page']))
						{
						$page=$_GET['page'];
							if($page==0 || $page<1){
								$showpost=0;
							}else{
						$showpost = ($page*5)-5;
						//echo $showpost;
							}
						$query= "SELECT * FRoM admin_panel ORDER BY datetime desc LIMIT $showpost,5";
						
						}
						//the default query of blog.php
						else
					{
						
						$query= "SELECT * FROM admin_panel ORDER BY datetime desc LIMIT 0,3";
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
							<p class="description">Category: <?php echo htmlentities($Category); ?> | Published on <?php echo htmlentities($Datetime); ?>
								

										<?php 

											$logic = "SELECT COUNT(*) FROM comments WHERE admin_panel_id = '$Postid' AND status='ON' ";
											$result= mysqli_query($con, $logic);
											$notify = mysqli_fetch_array($result);
											$show = array_shift($notify);
											if(($show)>0){
										?>
										<span class="badge float-right badge-success">Comments: <?php echo $show; ?></span>
										<?php } ?> 

							</p>
							<p><?php
									if (strlen($Post)>150) {
										$Post = substr($Post,0,150).'....';
									}
							echo nl2br($Post);?></p>
						</div>
						<a href="fullpost.php?id=<?php echo $Postid ?>"><span class="btn btn-info float-right mb-2">Read more &rsaquo; &rsaquo;</span></a>
					</div>
					<?php } ?>
				<nav>
					<ul class="pagination ">
				
				<?php 

				

				if(@$page>1)
					 //for backward button
				{
					?>
					<span class="page-item"><li><a class=" page-link" href="blog.php?page=<?php echo $page-1; ?>"> &laquo; </a></li></span>
				<?php } ?>


				<?php 

				$pagination = "SELECT COUNT(*) FROM admin_panel";
				$runquery = mysqli_query($con, $pagination);
				$pagination = mysqli_fetch_array($runquery);
				$totalpagination = array_shift($pagination);

				$postpagination = $totalpagination/5;
				$postpagination = ceil($postpagination);

				for($i=1; $i<=$postpagination; $i++ ){
					if(isset($page)){
					if ($i == $page) {
						
					?>
					<li class="page-item active"><a class="page-link" href="blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

				<?php
			}else{ ?>
					<li class="page-item"><a class="page-link" href="blog.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

			<?php } }  }?>
					

				<?php
				if(@$page+1<=$postpagination)
					//for forward button
				{
					?>
					<span class="page-item"><li><a class=" page-link" href="blog.php?page=<?php echo @$page+1; ?>"> &raquo; </a></li></span>
				<?php } ?>

				</ul>
			</nav>

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
							
						</div><!-- side recent bar -->
					</div>

				</div><!-- side area ends -->

				</div><!-- row ending -->
				</div><!-- container ends here -->
				
				<div id="footer"><!-- footer div -->
				
				<h6>Created By | Rajat Kumar Singh | &copy2019 All right reserved.</h6>
				<hr style="background-color: white;">
				<p>I have created this site just to practice my coding skills. I have created this site just to practice my coding skills. I have created this site just to practice my coding skills. I have created this site just to practice my coding skills -- Rajat &trade;</p>
			</div>
		</body>
	</html>