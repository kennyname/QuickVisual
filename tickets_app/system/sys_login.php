<?php require_once('../Connections/easyshop.php'); ?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) { 
session_start(); 
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($accesscheck)) {
  $GLOBALS['PrevUrl'] = $accesscheck;
  $_SESSION[$accesscheck];
}

if (isset($_POST['account'])) {
  $loginUsername=$_POST['account'];
  $password=$_POST['pass'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "system.php";
  $MM_redirectLoginFailed = "sys_login.php";
  $MM_redirecttoReferrer = false;
  mysqli_select_db($easyshop, $database_easyshop);
  
  $LoginRS__query=sprintf("SELECT sys_account, sys_pass FROM system_account WHERE sys_account='%s' AND sys_pass='%s'",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysqli_query($easyshop,$LoginRS__query) or die(mysql_error());
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $GLOBALS['MM_Username'] = $loginUsername;
    $GLOBALS['MM_UserGroup'] = $loginStrGroup;	      

    //register the session variables
    $_SESSION[$loginUsername];
    $_SESSION[$loginStrGroup];

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
	$_SESSION['MM_Username']="admin";
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>店家登入</title>
<style type="text/css">
<!--
body {
	background-image: url(../image/dfszgh.jpg);
}
.style1 {color: #FFFFFF}
-->
</style></head>

<body>
<form action="<?php echo $loginFormAction; ?>" method="POST" name="form1" target="_top">
  <div align="center">
    <p><br>
      <img src="../jpg/5.jpg" width="100%" height="179"></p>
    <table width="248" border="1">
      <tr>
        <td colspan="2" bgcolor="#414045"><div align="center" class="style1">店家登入</div></td>
      </tr>
      <tr>
        <td width="40" bgcolor="#414045"><div align="left" class="style1 style1">帳號</div></td>
        <td width="192" bgcolor="#414045"><div align="left" class="style1 style1">
          <input name="account" type="text" id="account">
        </div></td>
      </tr>
      <tr>
        <td bgcolor="#414045"><div align="left" class="style1 style1">密碼</div></td>
        <td bgcolor="#414045"><div align="left" class="style1 style1">
          <input name="pass" type="password" id="pass">
        </div></td>
      </tr>
    </table>  
    <br>
    <input type="submit" name="Submit" value="   登        入 ">
    <br>
    <br>
    <a href="../index.php">回首頁</a></div>
</form>
<div align="center"><a href="../index.php" target="_top" class="style1">回首頁</a><br>
</div>
<p>&nbsp;</p>
</body>
</html>
