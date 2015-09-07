<?php
include('../control panel/header.php');

function dateOffset()
{
  static $tbl = array('sec' => 1, 'min' => 60, 'hou' => 3600, 'day' => 86400, 'wee' => 604800);
  $delta = 0;

  foreach (func_get_args() as $arg)
  {
    $kv = explode('=', $arg);
    $delta += $kv[1] * $tbl[strtolower(substr($kv[0], 0, 3))];
  }

  return $delta;
}

$now = time();
$diff = dateOffset('day=5');
$then = $now - $diff;
	
if ($_GET['sure'] == "yes") {
	$sql = "DELETE FROM status_records WHERE timestamp < '$then'";
	
	echo "Deleting....<br>";
	
	if (mysql_query($sql)) {
		echo mysql_affected_rows() . " rows were DELETED!";
		}
	else echo "Error: "  . mysql_error();
}

else {
	
	
	echo "Delete all entries prior to this date? :" . date('r', $then) . " <br> If you want to proceed, <a href=\"cleanRecentStatuses.php?sure=yes\" target=\"_top\">click here</a>.";
}//end else

mysql_close($con);
?>
