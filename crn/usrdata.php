<?php

function getUserData($user, $info)
{
	$q = "SELECT $info FROM users WHERE user = '$user'";
	$r = mysql_query($q);
	return $r;
}
?>