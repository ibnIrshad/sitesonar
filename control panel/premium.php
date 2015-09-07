<?php

include ("header.php"); //connects to database and controls sessions
?>

<html>
<head>
<link href="../include/styles.css" rel="stylesheet" type="text/css" media="screen, tv, projection">
<title>SiteSonar.net: Premium Users Rock!</title>

</head>
<body>
<div class="outerwrapper" align="center">
  <div class="aligner" align="left">
<div class="topspacer"></div>

<div class="logo"><a href="main.php" title="Click to go to our Main Page" target="_top"><img border="0" src="../images/logo.jpg" alt="SiteSonar.net" /></a></div>
<div class="topsection">
  <h1> Premium Users Page</h1> 
  <?php if (!$session->logged_in) echo "</div>" ?>
  <?php
/**
 * User has already logged in, so display relavent links, including
 * a link to the admin center if the user is an administrator.
 */
if($session->logged_in){
?>
  <p>This is where you, as a premium user, can add multiple emails, and edit your text message settings. Thank you for using SiteSonar.net</p>
</div>
<div class="nav">
<?php
echo "<a class='accountFunctions' href=\"main.php\">Main Control Panel</a> &nbsp;&nbsp; | &nbsp;&nbsp;"
       ."<a class='accountFunctions' href=\"settings.php?user=$session->username\">Edit My Account & Settings</a> &nbsp;&nbsp; | &nbsp;&nbsp;";

   if($session->isAdmin()){
      echo "<a class='accountFunctions' href=\"../admin/admin.php\">Admin Center</a> &nbsp;&nbsp; | &nbsp;&nbsp;";
   } echo "<a class='accountFunctions' href=\"stats.php\">Site Reports & Statistics</a>&nbsp;&nbsp; | &nbsp;&nbsp;";
   	echo "<a class='accountFunctions' href=\"premium.php\">Premium User Options</a>&nbsp;&nbsp; | &nbsp;&nbsp;";
	echo "<a class='accountFunctions' href=\"process.php\">Logout</a>";

//The following code will get info about the user(i.e is a premium user and has a user level of 5)
$userinfo = $database->getUserInfo($session->username);
?>
<br>
</div>

<div class="columnLeft">
<h1>Multiple Email Alerts</h1>

  <?php if ($userinfo['userlevel'] >= 5) { // If user is Premium?> 
<div align="center">
<form action="premiumScript.php?edit=multimail" method="post" name="multiplemail" target="_top" id="multiplemail">
  <label>First Email (your original one)
  <input name="email" type="text" id="email" value="<?php echo $userinfo['email'] ?>" maxlength="50">
  </label>
  <br><br>
  <label>Second Email
  <input name="email2" type="text" id="email2" value="<?php echo $userinfo['email2'] ?>" maxlength="50">
  </label>
  <br><br>
  <label>Third Email
  <input name="email3" type="text" id="email3" value="<?php echo $userinfo['email3'] ?>" maxlength="50">
  </label>
  <br><br>
  <label>Fourth Email
  <input name="email4" type="text" id="email4" value="<?php echo $userinfo['email4'] ?>" maxlength="50">
  </label>
  <br><br>
  <label>
  <input type="submit" name="save" id="save" value="Save">
  </label>
</form>
</div>
<?php } 
else { 
echo "You are not a premium user! If you were, you could specify multiple emails to recieve alerts; from right here!";
}
?>
</div>

<div class="columnCenter">
<h1>Text Messaging (SMS) Alerts</h1>
  <?php if ($userinfo['userlevel'] >= 5) { // If user is Premium?> 
SMS Service coming soon - when adorton gives me his "free text messaging script". I must say I have my doubts on whether it will actually work.
<?php } 
else { 
echo "You are not a premium user! If you were, you could have text message alerts for your site! <a href=\"premiumRegister.php\" title=\"Register for our premium service!\" target=\"_top\">Click here</a> to become a premium user.";
}
?>
</div>

<div class="columnRight">
<h1><?php if ($userinfo['userlevel'] < 5) echo "Buy"; else echo "You Have"; ?> Premium Service</h1>

<p>SiteSonar Premium service has all the features of SiteSonar Free Service with the following extras:</p>
<ul>
  <li>Ability to send alerts to multiple email addresses</li>
  <li>Abitlity to monitor your sites more often; every 10 minutes and every 5 minutes</li>
  <li>Recieve text message alerts when your site comes down or back up</li>
  </ul>
<h3>Price: $2.99 US per month</h3>
<h2>Click below to recieve 5 months premium service for $10.95 (20% Off)!</h2>
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="isahas_1219695849_biz@yahoo.ca ">
<input type="hidden" name="item_name" value="Site Sonar Premium Service">
<select name="amount">
  <option value="2.99">1 Month ($2.99)</option>
  <option value="5.98">2 Months ($5.98)</option>
  <option value="8.97">3 Months ($8.97)</option>
  <option value="10.95" selected>5 Months ($10.95) 20% Discount!</option>
  <option value="26.88">1 Year ($26.88) 25% Discount!</option>
</select>
<input type="hidden" name="no_shipping" value="0">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="bn" value="PP-BuyNowBF">
<input type="hidden" name="custom" value="<?php echo $session->username; ?>">
<input type="hidden" name="cancel_return" value="http%3A%2F%2Fwww.sitesonar.net%2Fcontrol+panel%2Fpremium.php%3Ferror%3Dcancelled">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
</div>

<?php
}// end if not logged in
else {
	header('Location: ../index.php');
}
mysql_close($con);
?>
<div class="footer">
  <p>Website designed, owned and operated by Isa Hassen. Co-designer: Faiq Samsudeen. SiteSonar.net was designed as a free website monitoring service, free site monitoring, every 10 min to 1hr.</p>
</div>
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
</div>
</div>
</body>
</html>