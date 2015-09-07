<?php
include('header.php'); //Controls session, and connects to database
$userinfo = $database->getUserInfo($session->username);

if (!$session->logged_in) header('../index.php');

//if ($_GET['edit']=="multimail" && $userinfo['userlevel'] >= 5) { //If the user wants to edit multiple emails, and is a premium user
	
	if ($_POST['email']=="") $email1=NULL;
	else $email1=$_POST['email'];
	
	if ($_POST['email2']=="") $email2=NULL;
	else $email2=$_POST['email2'];
	
	if ($_POST['email3']=="") $email3=NULL;
	else $email3=$_POST['email3'];
	
	if ($_POST['email4']=="") $email4=NULL;
	else $email4=$_POST['email4'];
	
	$sql ="UPDATE users SET email='$email1' WHERE username = '$session->username'";
	$sql1 ="UPDATE users SET email2='$email2' WHERE username = '$session->username'";
	$sql2 ="UPDATE users SET email3='$email3' WHERE username = '$session->username'";
	$sql3 ="UPDATE users SET email4='$email4' WHERE username = '$session->username'";
	
	if (mysql_query($sql) && mysql_query($sql1) && mysql_query($sql2) && mysql_query($sql3)) {
		$_SESSION['popup']=save_success;
		header('Location: premium.php');
	}
	
	else echo "<h3>Error, could not update your emails. Please try logging out and logging back in, then trying again. </h3>" . mysql_error();
//}

?>