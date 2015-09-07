<?php
include ("header.php"); //connects to database and controls sessions
	
	if ($_POST['rnews']==yes) $news = $_POST['rnews'];
	else $news='no';

	$edit3 = "UPDATE users SET rnews = '$news' WHERE username = '$session->username'";
	
	if (!mysql_query($edit3, $con)) {
		echo "<h1>ERROR: Could not edit your settings. <a href=\"settings.php\" target=\"_top\">Click here</a> to go back and try again.</h1>" . mysql_error();
		}
	
	else {
		header('Location: settings.php?popup=save&user=' . $session->username);
		}

mysql_close($con);
?>