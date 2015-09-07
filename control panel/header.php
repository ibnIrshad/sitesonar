<?php
include("../include/session.php");

//My Sql Connection
$con = mysql_connect("db1559.perfora.net","dbo251384058","knqTen8q");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("db251384058", $con);

//End My SQl Connection
?>