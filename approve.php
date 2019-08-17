<?php require_once('include/dbcon.php'); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>

<?php 

if (isset($_GET['id']))
{
	$idfromurl = $_GET['id'];
	$admin=$_SESSION['user_name'];
	$query = "UPDATE comments SET status = 'ON', approvedby = '$admin' WHERE id='$idfromurl'";
	$run= mysqli_query($con, $query);

		if ($run) {
			
		$_SESSION['successmessage']="Comment approved successfully..";
		Redirect_to('comments.php');
		}else{
		$_SESSION['ErorMessage']="Comment failed to approve..";
		Redirect_to('comments.php');
		}

}


?>