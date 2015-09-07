<?php

include ("header.php"); //connects to database and controls sessions

//Ask the guy if he's sure he wants to delete

$site = $_GET['site'];

if ($_GET['sure']=='no') {
	echo("Are you really sure you want to delete your site,<b>" . "$site" . "</b>? If yes, <a href='deletesite.php?site=" . "$site" . "&sure=yes'>click here</a>, otherwise go back.");
}

//If he's sure, go ahead and delete the site from the database
else {

$user = $session->username;

if($session->logged_in){

	
	$sql="DELETE FROM websites
			WHERE alias = '$_GET[site]' AND user = '$user'";

	if (!mysql_query($sql,$con))
  	{
  	die('<h3>Whoops! There was an error in deleting your site. If this message keeps coming, try logging out and logging back in.</h3>' . mysql_error());
  	}

	else {
		$_SESSION['popup']='site_delete_success';
		header ('Location: main.php');
		}
} //end if session is logged in, start else

//if user is not logged in, redirect the guy to the main page
else{
header('Location: ../index.php');
	}
} //End of surety test

//Close My SQL connection
mysql_close($con);
?>