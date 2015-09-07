<?php

include ("header.php"); //connects to database and controls sessions

if($session->logged_in){
	$orig_alias = $_GET['site'];
	
	$edit_alias = $_POST['edit_alias'];
	$edit_url = $_POST['edit_url'];
	$edit_interval = $_POST['edit_interval'];
	
	if ($_POST['rdown']==yes) $edit_rdown = $_POST['rdown'];
	else $edit_rdown='no';
	
	if ($_POST['rup']==yes) $edit_rup = $_POST['rup'];
	else $edit_rup='no';
		
	$sql = "UPDATE websites SET alias = '$edit_alias', url = '$edit_url', checkInterval = '$edit_interval',rdown = '$edit_rdown', rup = '$edit_rup'
	WHERE alias = '$orig_alias' AND user = '$session->username'";
	
	if (!mysql_query($sql,$con))
  	{
  	die('<h3>Error: Could not edit site. Waaaaaah</h3>');
  	}
	
	else 
	{
	//echo "Site edited successfully!";
	$_SESSION['popup']='site_edit_success';
	header('Location: main.php');
	}

mysql_close($con);

}//end if session logged in start else

else {
header('Location: ../index.php');
}
?>