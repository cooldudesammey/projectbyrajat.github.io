<?php require_once('include/dbcon.php'); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>

<?php 

if (isset($_GET['id']))
{
	$idfromurl = $_GET['id'];
	$query = "UPDATE comments SET status = 'OFF' WHERE id='$idfromurl'";
	$run= mysqli_query($con, $query);

		if ($run) {
			
		$_SESSION['successmessage']="Comment revoked successfully..";
		Redirect_to('comments.php');
		}else{
		$_SESSION['ErorMessage']="Comment failed to revoke..";
		Redirect_to('comments.php');
		}

}


?>