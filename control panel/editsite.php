<?php

include ("header.php"); //connects to database and controls sessions

if($session->logged_in){

	//Site to be edited stored in a variable.   
	$edit_site = $_GET['site'];
?>
<html>
<head>
<link href="../include/styles.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="controlbox">
  <h3><a href="editsite.php" target="_top">Edit Site Details</a></h3>

  <form name="edit_site_form" method="post" action="editor.php<?php echo '?site=' . "$_GET[site]" . '&url=' . "$_GET[url]" ;?>">
    <label>Site Name
    <input name="edit_alias" type="text" id="edit_alias" value="<?php echo "$_GET[site]"; ?>" maxlength="10">
    </label>
    <br>
    <label>Site URL
    <input name="edit_url" type="text" id="edit_url" value="<?php echo "$_GET[url]"; ?>" maxlength="75">
    </label>
    <br>
    <label>How often should this site be checked?</label>
  <select name="edit_interval" id="edit_interval">
    <option value="10min" <?php if ($_GET[interval]=='10min') echo 'selected="selected"'; ?>>Every 10 min</option>
    <option value="15min" <?php if ($_GET[interval]=='15min') echo 'selected="selected"'; ?>>Every 15 min</option>
    <option value="20min" <?php if ($_GET[interval]=='20min') echo 'selected="selected"'; ?>>Every 20 min</option>
    <option value="30min" <?php if ($_GET[interval]=='30min') echo 'selected="selected"'; ?>>Every 30 min</option>
    <option value="45min" <?php if ($_GET[interval]=='45min') echo 'selected="selected"'; ?>>Every 45 min</option>
    <option value="1hr" <?php if ($_GET[interval]=='1hr') echo 'selected="selected"'; ?>>Every hour</option>
  </select>
  (short time intervals put heavy load on our server, 20-30min is recommended for best performance)<br>
   <label>
  <input name="rdown" type="checkbox" id="rdown" value="yes" <?php if ($_GET['rdown']==yes) echo "checked"; ?>>
  Do you want to receive an email if this site goes down?</label>
  <br>
  <label>
  <input name="rup" type="checkbox" id="rup" value="yes" <?php if ($_GET['rup']==yes) echo "checked"; ?>>
  Do you want to receive an email if this site comes back up (after it has gone down)?</label>
  <br />
  <label>
  <input type="submit" name="submit" id="submit" value="Edit Site">
  </label>
  
<br />
  </form>
</div>

<?php
	
} //end if session is logged in, start else

//if user is not logged in, redirect the guy to the main page
else{
header('Location: ../main.php');
}

//Close My SQL connection
mysql_close($con);
?>
<div align="center"><a title="Clicky Web Analytics" href="http://getclicky.com/29859"><img align="center" alt="Clicky Web Analytics" src="http://static.getclicky.com/media/links/badge.gif" border="0" /></a>
  
  <script src="http://static.getclicky.com/42172.js" type="text/javascript"></script>
  
  <noscript>
  <p><img alt="Clicky" src="http://in.getclicky.com/42172-db6.gif" /></p>
  </noscript>
  <script src="http://static.getclicky.com/42172.js" type="text/javascript"></script>
  <noscript>
  <p><img alt="Clicky" src="http://in.getclicky.com/42172-db6.gif" /></p>
  </noscript>
</div>
</body>
</html>