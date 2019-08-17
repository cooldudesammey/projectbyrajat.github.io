<?php require_once('include/dbcon.php'); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>

<?php 

if (isset($_GET['id']))
{
	$idfromurl = $_GET['id'];
	$query = "DELETE FROM signup WHERE id='$idfromurl'";
	$run= mysqli_query($con, $query);

		if ($run) {
			
		$_SESSION['successmessage']="Admin deleted successfully..";
		Redirect_to('manageaccount.php');
		}else{
		$_SESSION['ErorMessage']="Admin failed to delete..";
		Redirect_to('manageaccount.php');
		}

}


?>