<?php
//initialize the session
if(!isset($_SESSION)){  
   session_start();  
}  


// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "sys_login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<? include "s_include.php" ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>無標題文件</title>
<style type="text/css">
<!--
body {
	background-color: #FFFEE8;
	background-image: url(../jpg/5.jpg);
}
.style5 {font-size: 16px; color: #916446; }
.style6 {font-size: 16px; color: #FFFFFF; }
.style7 {color: #FFFFFF}
-->
</style></head>

<body>

<p>&nbsp; </p>
<table width="100%" height="206" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr>
    <td colspan="2" bgcolor="#0B0B0B"><img src="../jpg/KYKHGK.jpg" width="100%" height="125"></td>
  </tr>
    <tr>
    <td colspan="2" bgcolor="#0B0B0B"><a href="s_account2.php" target="mainFrame" class="style5 style7">會員管理與加值</a>
    <hr color="#916446"></td></tr>
  <tr>
    <td colspan="2" bgcolor="#0B0B0B"><a href="s_upstore.php" target="mainFrame" class="style5 style7">電影資訊新增</a>
    <hr color="#916446"></td></tr>
  <tr>
    <td colspan="2" bgcolor="#0B0B0B"><a href="s_upstore_del.php" target="mainFrame" class="style6">電影資訊管理</a>
    <hr color="#916446"></td></tr>
 <tr>
    <td colspan="2" bgcolor="#0B0B0B"><a href="s_talk.php" target="mainFrame" class="style6">意見回饋查詢</a>
    <hr color="#916446"></td></tr><tr>
    <td colspan="2" bgcolor="#0B0B0B"><a href="ch_syspass.php" target="mainFrame" class="style6">更改密碼</a>
    <hr color="#916446"></td></tr>
  <tr>
    <td colspan="2" bgcolor="#0B0B0B"><a href="<?php echo $logoutAction ?>" target="_top" class="style6">登出系統</a>
    <hr color="#916446"></td></tr>
  <tr bgcolor="#0B0B0B">
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
