<?php
include('../control panel/header.php'); //Controls session, logs into MySql Database

if(!$session->isAdmin()){
   header("HTTP/1.0 404 Not Found"); //If an unauthorized person (non admin) tries to access, this will return a 404 error
}

$uinfo = $database->getUserInfo($_GET['id']);

if ($_GET['sure'] != 'yes') echo $uinfo['username'] . " will be deleted. <a href=\"deleteuser.php?sure=yes&id=$_GET[id]&time=$_GET[time]\">Ok</a>?";

if ($_GET['sure']==yes && isset($_GET['id']) && isset($_GET['time']) ){
	
	if (!$uinfo) die('Stupid hacker. You think you can hack SiteSonar, eh? Well you can\'t, so get lost.');
	if ($_GET['time'] != $uinfo['timestamp']) die('Stupid hacker. You think you can hack SiteSonar, eh? Well you can\'t, so get lost.');
	
	$database->removeActiveUser($_GET['username']);
	
	echo "deleted";
	
}