<?php
/**
 * UserInfo.php
 *
 * This page is for users to view their account information
 * with a link added for them to edit the information.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 26, 2004
 */
include("../include/session.php");
?>

<html>
<title>DLG1 Server - Script under construction</title>
<body>

<?php
/* Requested Username error checking */
$req_user = trim($_GET['user']);
if(!$req_user || strlen($req_user) == 0 ||
   !eregi("^([0-9a-z])+$", $req_user) ||
   !$database->usernameTaken($req_user)){
   die("Username not registered");
}

/* Logged in user viewing own account */
if(strcmp($session->username,$req_user) == 0){
   echo "<h1>My Account</h1>";
}
/* Visitor not viewing own account */
else{
   echo "<h1>User Info</h1>";
}

/* Display requested user information */
$req_user_info = $database->getUserInfo($req_user);

/* Username */
echo "<b>Username: ".$req_user_info['username']."</b><br>";

/* Email */
echo "<b>Email:</b> ".$req_user_info['email']."<br>";

/**
 * Note: when you add your own fields to the users table
 * to hold more information, like homepage, location, etc.
 * they can be easily accessed by the user info array.
 *
 * $session->user_info['location']; (for logged in users)
 *
 * ..and for this page,
 *
 * $req_user_info['location']; (for any user)
 */

/* If logged in user viewing own account, give link to edit */
if(strcmp($session->username,$req_user) == 0){
   echo "<br><a href=\"settings.php\">Edit Account Information</a><br>";
}

/* Link back to main */
echo "<br>Back To [<a href=\"main.php\">Main</a>]<br>";

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
