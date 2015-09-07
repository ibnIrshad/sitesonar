<?php

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

//---------My Sql Connection
$con = mysql_connect("db1559.perfora.net","dbo251384058","knqTen8q");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("db251384058", $con);
//--------End My SQl Connection

$all_data = mysql_query("SELECT * FROM websites");

while($row = mysql_fetch_array($all_data))
  {
	if(Visit($row['URL']))
		{
			echo "$row[alias]";
			echo " <i>'" . "$row[URL]" . "'</i>";
			echo " <b>Website OK</b>";
			echo "<br />";
		}
     
	 	else
		{
			echo "$row[alias]";
			echo " <i>'" . "$row[URL]" . "'</i>";
			echo " <b>Website DOWN</b>";
			echo "<br />";
		}
  }
  mysql_close($con);
?>