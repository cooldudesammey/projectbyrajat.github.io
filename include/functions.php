
<?php require_once("include/dbcon.php"); ?>
<?php require_once("include/sessions.php"); ?>

<?php 

function Redirect_to($New_location)
{
	header("Location:".$New_location);
	exit;
}


function loginattempt($username, $password)
{
	include'include/dbcon.php';
	$query = "SELECT * FROM signup WHERE username='$username' AND password='$password'";
	$run = mysqli_query($con, $query);
	if ($admin=mysqli_fetch_assoc($run)) {
		return $admin;
	}else{
		return null;
	}
}


function login()
{
	if (isset($_SESSION['user_id'])) {
		return true;
	}
	
}


function confirm_login(){
	if(!login()){
		$_SESSION['ErorMessage']="Login required !";
		redirect_to('login.php');
	}
}
?>