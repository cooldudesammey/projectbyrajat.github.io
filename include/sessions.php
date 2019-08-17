<?php 

session_start();

function message(){
	if (isset($_SESSION['ErorMessage'])) {
		$output="<div class=\"alert alert-danger mt-4\">";
		$output.=htmlentities($_SESSION['ErorMessage']);
		$output.="</div>";
		$_SESSION['ErorMessage']= null;
		return $output;
	}
}


function successmessage(){
	if (isset($_SESSION['successmessage'])) {
		$output="<div class=\"alert alert-success mt-4\">";
		$output.=htmlentities($_SESSION['successmessage']);
		$output.="</div>";
		$_SESSION['successmessage']= null;
		return $output;
	}
}
?>
