 <?php require_once('Connections/connSQL.php'); ?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['acc'])) {
  $loginUsername=$_POST['acc'];
  $password=$_POST['pass'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "acc_index.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;
  mysqli_select_db($connSQL, $database_connSQL);
  
  $LoginRS__query=sprintf("SELECT a_account, a_pass FROM a_account WHERE a_account='%s' AND a_pass='%s'",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysqli_query($connSQL,$LoginRS__query) or die(mysql_error());
  $loginFoundUser = mysqli_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;
    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
if(@$_SESSION['MM_Username']<>"")header("Location: acc_index.php");
?>
<!-- //regist -->
<?php require_once('Connections/connSQL.php'); ?>
<?php
mysqli_select_db($connSQL, $database_connSQL);
$query_rs = "SELECT * FROM news ORDER BY n_id ASC";
$rs = mysqli_query($connSQL,$query_rs) or die(mysql_error());
$row_rs = mysqli_fetch_assoc($rs);
$totalRows_rs = mysqli_num_rows($rs);
?>
<?php require_once('Connections/easyshop.php'); ?>
<? //include "u_include.php" ?>
<?php
// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="add_user2.php?id=2";
  $loginUsername = $_POST['a1'];
  $LoginRS__query = "SELECT a_account FROM a_account WHERE a_account='" . $loginUsername . "'";
  mysqli_select_db($easyshop,$database_easyshop);
  $LoginRS=mysqli_query($easyshop,$LoginRS__query) or die(mysql_error());
  $loginFoundUser = mysqli_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO a_account (a_joinname,a_area,a_account, a_pass, a_name, a_address, a_phone, a_sogi, atm) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
   GetSQLValueString($_POST['a_joinname'], "text"),
    GetSQLValueString($_POST['a_area'], "text"),
                       GetSQLValueString($_POST['a1'], "text"),
                       GetSQLValueString($_POST['a2'], "text"),
                       GetSQLValueString($_POST['a3'], "text"),
                       GetSQLValueString($_POST['a4'], "text"),
                       GetSQLValueString($_POST['a5'], "text"),
                       GetSQLValueString($_POST['a6'], "text"),
                       GetSQLValueString($_POST['atm'], "text"));

  mysql_select_db($easyshop, $database_easyshop);
  $Result1 = mysqli_query($easyshop,$insertSQL) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
 <!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="description" content="最新好看的電影都在這裡喔" />
  <meta name="keywords" content="最新 上映" />
  <title>Quick-Visual</title>
   <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css'>
  <link rel="stylesheet" href="css/new/style.css">
</head>

<body>


<div class="container1"></div>
<nav class="navbar navbar-default navbar-fixed-top navbar-top">
  <div class="container">
    <div class="navbar-header"><a class="navbar-brand">Qiuck-Visual</a></div>
    <div class="navbar-collapse collapse">
      <div class="nav navbar-nav navbar-right">
        <li><a href="index.php">線上訂票</a></li>
        <li><a href="index.php">電影資訊</a></li>
        <li><a href="sys.php">店家中心</a></li>
        <li><a href="index.php">意見回饋</a></li>
        <li><a href="about.php">關於我們</a></li>
      </div>
    </div>
  </div>
</nav>
<div class="logo">  
  <div class="icon animate"><img src="http://i.imgur.com/anoANgd.png" width="120" height="150"/></div>
  <div class="pipe">|</div>
  <div class="name">Quick-Visual</div>
  <div class="btn1">Enter</div>
</div>
<div class="page2">
<div class="body"></div>
<div class="grad"></div>
<div class="header">
  <div>Quick<span>-</span><span>Visual</span></div>
</div><br/>
<form name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
<div class="login">
  <input type="text" placeholder="username" size="15" name="acc" id="acc"/>
  <input type="password" placeholder="password" size="15" name="pass" id="pass"/><br/>
  <input class="login_btn" type="submit" value="submit"/>
  <input class="regist" type="button" value="Regist"/>
</div>
</form>
<form action="<?php echo $editFormAction; ?>" method="POST" name="form2" onSubmit="return aaa( );">
<div class="regist_form">
  <input type="text" placeholder="account" size="15" name="a1" id="a1"/><br/>
  <input type="password" placeholder="password" size="15" name="a2" size="15" id="a2"/><br/>
  <input type="password" placeholder="name" id="a3" name="a3"/><br/>
  <input type="text" placeholder="address" id="a4" name="a4"/><br/>
  <input type="text" placeholder="Phone" id="a5" name="a5"/><br/> 
  <input type="text" placeholder="E-mail" id="a6" name="a6"/><br/>
  <input class="confirm" type="submit" value="Regist"/>
</div>
<input type="hidden" name="MM_insert" value="form1">
</form>
	</div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>

    <script src="js/new/index.js"></script>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-92534111-3', 'auto');
  ga('send', 'pageview');

  function aaa(){
if(document.form2.a1.value==""){
alert ("帳號要填唷!")
return false
}else if (document.form2.a2.value==""){
alert ("密碼要填唷!")
return false
}else if (document.form2.a3.value==""){
alert ("姓名要填唷!")
return false

}else if (document.form2.a5.value==""){
alert ("電話要填唷!")
return false

 

}
alert ("加入完畢!")
}
</script>

</body>
</html>
