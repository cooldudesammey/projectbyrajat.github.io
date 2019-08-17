<?php require_once('include/dbcon.php'); ?>
<?php require_once("include/sessions.php"); ?>
<?php require_once("include/functions.php"); ?>

<?php 

if (isset($_GET['id']))
{
	$idfromurl = $_GET['id'];
	$query = "DELETE FROM category WHERE id='$idfromurl'";
	$run= mysqli_query($con, $query);

		if ($run) {
			
		$_SESSION['successmessage']="Category deleted successfully..";
		Redirect_to('categories.php');
		}else{
		$_SESSION['ErorMessage']="Category failed to delete..";
		Redirect_to('categories.php');
		}

}


?>