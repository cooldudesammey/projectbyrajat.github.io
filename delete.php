<?php require_once('include/dbcon.php'); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>

<?php 

if (isset($_GET['id']))
{
	$idfromurl = $_GET['id'];
	$query = "DELETE FROM comments WHERE id='$idfromurl'";
	$run= mysqli_query($con, $query);

		if ($run) {
			
		$_SESSION['successmessage']="Comment Deleted successfully..";
		Redirect_to('comments.php');
		}else{
		$_SESSION['ErorMessage']="Comment failed to delete..";
		Redirect_to('comments.php');
		}

}


?>