<?php

include ("header.php"); //connects to database and controls sessions

if($session->logged_in){

$user_info = $database->getUserInfo($session->username);
$user_email  = $user_info['email'];

function Visit($url)

{

$agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";$ch=curl_init();

curl_setopt ($ch, CURLOPT_URL,$url );

curl_setopt($ch, CURLOPT_USERAGENT, $agent);

curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

curl_setopt ($ch,CURLOPT_VERBOSE,false);

curl_setopt($ch, CURLOPT_TIMEOUT, 5);

$page=curl_exec($ch);

//echo curl_error($ch);

$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

if($httpcode>=200 && $httpcode<300) return true;

else return false;

}

if (Visit($_POST['url_submit'])) {
$status = 'UP';
}

else {
$status = 'DOWN';
}

if ($_POST['rdown']==yes) $rdown = $_POST['rdown'];
	else $rdown='no';

if ($_POST['rup']==yes) $rup = $_POST['rup'];
	else $rup='no';

//---If the user tries 5min or 10min, this checks if he is a premium user
if ($_POST['interval_submit'] == '10min' || $_POST['interval_submit'] == '5min') {

	if ($user_info['userlevel'] < 5) { //if the guy is not a premium user
	$_SESSION['popup']='not_premium';
	header ('Location: main.php');
	exit;
	}
}



	$sql="INSERT INTO websites (URL, alias, user, checkinterval, status, uptime, downtime, rdown, rup)
	VALUES
	('$_POST[url_submit]','$_POST[sitename_submit]','$session->username', '$_POST[interval_submit]', '$status', '1', '1', '$rdown', '$rup')";

	if (!mysql_query($sql,$con))
  	{
  	die('<h3>Error: That site is already listed! You goin bonkers or what?</h3>');
  	}

	else {
		$_SESSION['popup']='site_add_success';
		header ('Location: main.php');
		}
} //end if session is logged in, start else

//if user is not logged in, redirect the guy to the main page
else{
header('Location: ../index.php');
}

//Close My SQL connection
mysql_close($con);
?>